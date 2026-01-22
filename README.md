This is a production-ready Yii 2 Advanced Template project demonstrating professional Redis caching implementation with complete CRUD operations, cache invalidation, TTL management, and a real-time cache statistics dashboard.

✨ Features
Advanced Redis Caching with automatic invalidation on data changes.
Multi-language support (English/Arabic localization with RTL support).
Admin Panel with role-based access control (RBAC).
User Frontend with optimized performance and caching.
Cache Statistics Dashboard – Monitor Redis usage, memory, and key counts in real-time.
Automatic cache clearing triggered by data modifications (create, update, delete).
10-minute TTL (Time-To-Live) with smart cache key generation for efficient storage.
Console commands for cache management and migrations.
🚀 Quick Start
Prerequisites
PHP 7.4+ (Tested on PHP 7.4.33 and 8.1+).
MySQL 5.7+ or MariaDB 10.3+ (Tested on MySQL 8.2.0).
Redis Server 5.0+ (Required for caching; install and ensure it's running).
Composer 2.0+ for dependency management.
Web server: Apache/Nginx with mod_rewrite enabled (or equivalent).
Git for cloning the repository.
Installation Steps
1. Clone the Repository and Install Dependencies
   bash

Copy code
# Clone the repository (replace with your actual repo URL)
git clone https://github.com/your-username/your-repo.git
cd your-repo

# Install PHP dependencies via Composer
composer install
2. Set Up the Database
   bash

Copy code
# Create the database (adjust credentials as needed)
mysql -u root -p -e "CREATE DATABASE painter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import the database structure
mysql -u root -p painter < database/structure.sql

# (Optional) Import sample data for testing
mysql -u root -p painter < database/sample_data.sql
3. Configure the Application
   bash

Copy code
# Copy example configuration files
cp common/config/db.php.example common/config/db.php
cp common/config/main.php.example common/config/main.php

# Edit these files with your database and Redis credentials:
# - common/config/db.php: Set database host, username, password, and name (e.g., 'painter').
# - common/config/main.php: Configure Redis connection (e.g., host: '127.0.0.1', port: 6379).
# Note: Never commit real credentials to version control. Use environment variables in production.
4. Install and Configure Redis
   bash

Copy code
# On Ubuntu/Debian
sudo apt update
sudo apt install redis-server
sudo systemctl start redis
sudo systemctl enable redis

# On CentOS/RHEL
sudo yum install redis
sudo systemctl start redis
sudo systemctl enable redis

# On macOS (via Homebrew)
brew install redis
brew services start redis

# On Windows: Use WSL or a tool like Redis for Windows (not recommended for production).
Test Redis:

bash

Copy code
redis-cli ping  # Should return "PONG"
5. Run Migrations and Initialize
   bash

Copy code
# Run database migrations
php console/yii migrate

# (Optional) Seed initial data if available
php console/yii migrate/data
6. Set Up Web Server
   Point your web server's document root to the frontend/web directory for the frontend and backend/web for the admin panel.
   Ensure URL rewriting is enabled (e.g., for Apache, enable mod_rewrite and use the provided .htaccess).
   Example Apache config snippet:

Copy code
<VirtualHost *:80>
ServerName your-domain.com
DocumentRoot /path/to/your-repo/frontend/web
<Directory "/path/to/your-repo/frontend/web">
AllowOverride All
Require all granted
</Directory>
</VirtualHost>
For production, use HTTPS, set proper file permissions, and configure environment variables.
7. Access the Application
   Frontend: http://localhost/your-folder
   Admin Panel: http://localhost/your-folder/admin
   Default login: Email: admin@example.com, Password: 12345678 (Change this immediately in production!)
   🧪 Testing Redis Caching Features
   Step 1: Log In to the Admin Panel
   Open your browser and navigate to: http://localhost/your-folder/admin
   Log in with: 
   Email: yusef.shahoud@gmail.com
   Password: 12345678
   Step 2: Test Category Caching
   Navigate to: Categories → List.
   First Load: You'll see "Cache: Miss" (data loaded from the database). Note the load time in flash messages.
   Refresh the Page: You'll see "Cache: Hit" (data served from Redis). Load time should be faster.
   Step 3: Test Cache Invalidation
   Create a new category: Cache automatically clears for related keys.
   Edit a category: Related caches are invalidated.
   Delete a category: All category caches are cleared.
   Manual Clear: Use the "Clear Cache" button in the admin panel to manually flush all Redis caches.
   Step 4: View Cache Statistics
   Go to: Categories → Cache Statistics.
   View metrics such as:
   Total Redis keys.
   Memory usage.
   Category cache keys count.
   Redis server uptime.
   💻 Redis Implementation Code Highlights
   This project uses Redis as the primary cache component in Yii 2. Ensure your common/config/main.php includes a Redis cache configuration like this:

php

Copy code
'components' => [
'cache' => [
'class' => 'yii\redis\Cache',
'redis' => [
'hostname' => '127.0.0.1',
'port' => 6379,
'database' => 0,
],
],
'redis' => [
'class' => 'yii\redis\Connection',
'hostname' => '127.0.0.1',
'port' => 6379,
'database' => 0,
],
],
Smart Cache Key Generation
In backend/controllers/CategoryController.php (or similar), generate unique keys based on query parameters for efficient caching:

php

Copy code
<?php
// Assuming this is inside a controller method, e.g., actionIndex()
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
    const CACHE_PREFIX = 'category_';  // Define a constant for cache key prefix
    const CACHE_TTL = 600;  // 10 minutes TTL

    public function actionIndex($params = [])
    {
        // Generate a unique cache key based on serialized parameters
        $cacheKey = self::CACHE_PREFIX . 'list_' . md5(serialize($params));
        
        // Try to get data from cache
        $data = Yii::$app->cache->get($cacheKey);
        
        if ($data === false) {
            // Cache miss: Fetch from database
            $data = $this->fetchCategoriesFromDb($params);  // Replace with your actual query logic
            
            // Store in cache with TTL
            Yii::$app->cache->set($cacheKey, $data, self::CACHE_TTL);
            
            // Track the key for invalidation (store in a Redis set)
            Yii::$app->redis->sadd(self::CACHE_PREFIX . 'keys', $cacheKey);
            
            Yii::$app->session->setFlash('info', 'Cache: Miss (Loaded from DB)');
        } else {
            Yii::$app->session->setFlash('success', 'Cache: Hit (Served from Redis)');
        }
        
        return $this->render('index', ['data' => $data]);
    }

    private function fetchCategoriesFromDb($params)
    {
        // Example: Replace with your actual model query
        return \common\models\Category::find()->where($params)->all();
    }
}
Automatic Cache Invalidation
Add a method to clear related caches when data changes (e.g., in create/update/delete actions):

php

Copy code
<?php
// Inside the same CategoryController.php

private function invalidateCategoryCaches()
{
    $setKey = self::CACHE_PREFIX . 'keys';
    
    // Get all tracked cache keys from the Redis set
    $keys = Yii::$app->redis->smembers($setKey);
    
    if (!empty($keys)) {
        // Delete each key from cache
        foreach ($keys as $key) {
            Yii::$app->cache->delete($key);
        }
        
        // Clear the set of keys
        Yii::$app->redis->del($setKey);
        
        Yii::$app->session->setFlash('warning', 'Category caches invalidated.');
    }
}

// Example usage in an action (e.g., after saving a category)
public function actionCreate()
{
    $model = new \common\models\Category();
    
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        $this->invalidateCategoryCaches();  // Clear caches after change
        return $this->redirect(['index']);
    }
    
    return $this->render('create', ['model' => $model]);
}
Additional Notes on Implementation
TTL Management: All caches use a 10-minute TTL to prevent stale data. Adjust CACHE_TTL as needed.
Error Handling: In production, wrap Redis operations in try-catch blocks to handle connection failures gracefully.
Statistics Dashboard: Implement a custom action in the controller to query Redis info (e.g., using Yii::$app->redis->info()).
Performance Tips: Use Redis clustering for high-traffic sites. Monitor with tools like Redis Insight.
Testing: Use Yii's built-in testing framework (e.g., Codeception) to verify cache behavior.
📁 Directory Structure

Copy code
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
database/                contains SQL files for structure and sample data
🐛 Troubleshooting
Redis Connection Issues: Ensure Redis is running and accessible. Check firewall settings.
Database Errors: Verify credentials in db.php and that the database exists.
Permission Issues: Set proper file permissions (e.g., chmod 755 on directories, 644 on files).
Caching Not Working: Confirm Redis is configured as the cache component in main.php.
For more help, check the Yii 2 Documentation or open an issue in the repository.
📄 License
This project is licensed under the MIT License. See the LICENSE file for details.