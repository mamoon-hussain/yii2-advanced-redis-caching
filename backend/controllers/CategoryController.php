<?php

namespace backend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\models\LocalizedCategory;
use Yii;
use common\models\Category;
use common\models\generated\search\CategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends \common\utils\Controller
{

    const CACHE_PREFIX = 'cat_';
    const CACHE_TTL = 600; // 10 minutes

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'localization', 'delete', 'change-status', 'clear-cache', 'cache-stats'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'clear-cache' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models with Redis caching
     * @return mixed
     */
    public function actionIndex()
    {
        $startTime = microtime(true);
        $searchModel = new CategorySearch();
        $params = Yii::$app->request->queryParams;

        // Generate unique cache key based on search parameters
        $cacheKey = self::CACHE_PREFIX . 'list_' . md5(serialize($params));

        // Try to get from cache first
        $data = Yii::$app->cache->get($cacheKey);

        if ($data === false) {
            // Cache miss - fetch from database
            $dataProvider = $searchModel->search($params);
            $data = [
                'models' => $dataProvider->getModels(),
                'pagination' => $dataProvider->getPagination(),
                'sort' => $dataProvider->getSort(),
                'totalCount' => $dataProvider->getTotalCount(),
            ];

            // Store in Redis with TTL
            Yii::$app->cache->set($cacheKey, $data, self::CACHE_TTL);

            // Store the cache key for later invalidation
            $this->storeCacheKey($cacheKey);

            Yii::info("Cache miss for key: {$cacheKey}", 'redis');
            $cacheStatus = 'Miss';
        } else {
            // Cache hit - rebuild dataProvider from cached data
            Yii::info("Cache hit for key: {$cacheKey}", 'redis');

            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $data['models'],
                'pagination' => $data['pagination'],
                'sort' => $data['sort'],
                'totalCount' => $data['totalCount'],
            ]);
            $cacheStatus = 'Hit';
        }

        $loadTime = microtime(true) - $startTime;

        if (YII_DEBUG) {
            Yii::$app->session->setFlash('flash_success',
                "Page loaded in " . round($loadTime, 4) . "s (Cache: {$cacheStatus})"
            );
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model with caching
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $cacheKey = self::CACHE_PREFIX . "item_{$id}";
        $model = Yii::$app->cache->get($cacheKey);

        if ($model === false) {
            $model = $this->findModel($id);
            Yii::$app->cache->set($cacheKey, $model, self::CACHE_TTL);
            $this->storeCacheKey($cacheKey);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Category model with cache invalidation
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->status = ActiveInactiveStatus::active;
            $model->created_date = date(Constents::full_date_format);

            // Validate first
            if (!$model->validate()) {
                Yii::$app->session->setFlash('flash_error',
                    t('Please fix the errors below: ') .
                    implode(', ', array_map(function($errors) {
                        return implode(', ', $errors);
                    }, $model->errors))
                );
            } elseif ($model->save()) {
                // Clear category-related caches
                $this->invalidateCategoryCaches();

                // Clear specific item cache
                $cacheKey = self::CACHE_PREFIX . "item_{$model->id}";
                Yii::$app->cache->delete($cacheKey);

                Yii::$app->session->setFlash('flash_success', t("Category created successfully"));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::error('Failed to save category: ' . print_r($model->errors, true));
                Yii::$app->session->setFlash('flash_error',
                    t('Failed to save category. Please try again.')
                );
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model with cache invalidation
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                // Invalidate all category caches
                $this->invalidateCategoryCaches();

                // Clear specific item cache
                $cacheKey = self::CACHE_PREFIX . "item_{$id}";
                Yii::$app->cache->delete($cacheKey);

                Yii::$app->session->setFlash('flash_success', t("Saved"));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model with cache invalidation
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            // Invalidate all category caches
            $this->invalidateCategoryCaches();

            // Clear specific item cache
            $cacheKey = self::CACHE_PREFIX . "item_{$id}";
            Yii::$app->cache->delete($cacheKey);

            Yii::$app->session->setFlash('flash_success', t('Deleted successfully'));
        } else {
            Yii::$app->session->setFlash('flash_error', t('Failed to delete'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Change status with cache invalidation
     */
    public function actionChangeStatus($id, $s)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($post) {
            $model->status = $post['status'];

            if ($model->save()) {
                // Invalidate caches
                $this->invalidateCategoryCaches();

                // Clear specific item cache
                $cacheKey = self::CACHE_PREFIX . "item_{$id}";
                Yii::$app->cache->delete($cacheKey);

                Yii::$app->session->setFlash('flash_success', t('Saved'));
                return $this->redirect(['index?t='.$model->type.'']);
            }
        }

        return $this->renderAjax('/shared/change_status', [
            'model' => $model,
            'title' => t('Change Status'),
            'content' => t('Are you sure?'),
            'status' => $s,
        ]);
    }

    /**
     * Clear all category caches manually
     */
    public function actionClearCache()
    {
        $count = $this->invalidateCategoryCaches();

        Yii::$app->session->setFlash('flash_success',
            t('Cleared {count} cache entries', ['count' => $count])
        );

        return $this->redirect(['index']);
    }

    /**
     * Show cache statistics
     */
    public function actionCacheStats()
    {
        $stats = [];

        // Get Redis stats if available
        if (Yii::$app->has('redis')) {
            $redis = Yii::$app->redis;

            // Get memory info
            $info = $redis->executeCommand('INFO');
            $stats['redis'] = [
                'total_keys' => $redis->executeCommand('DBSIZE'),
                'memory_used' => $info['used_memory_human'] ?? 'N/A',
                'uptime' => $info['uptime_in_seconds'] ?? 'N/A',
            ];

            // Get category cache keys
            $categoryKeys = $redis->executeCommand('KEYS', [self::CACHE_PREFIX . '*']);
            $stats['category_cache'] = [
                'total_keys' => count($categoryKeys),
                'keys' => $categoryKeys,
            ];
        }

        return $this->render('cache-stats', ['stats' => $stats]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLocalization($id)
    {
        $itemModel = Category::findOne($id);
        $langModels = [];
        foreach (Yii::$app->params['languages'] as $one){
            $langModel = LocalizedCategory::find()
                ->andWhere(['lang' => $one])
                ->andWhere(['item_id' => $id])
                ->one();
            if(!$langModel){
                $langModel = new LocalizedCategory();
                $langModel->item_id = $id;
                $langModel->lang = $one;
            }
            $langModels[$one] = $langModel;
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $ok = true;
            $dependancies = [];
            foreach ($langModels as $lang => $langModel){
                $langModel->load(['LocalizedCategory' => $post[$lang.'_LocalizedCategory']]);
                if(!$langModel->save()){
                    $ok = false;
                    \Yii::$app->getSession()->setFlash('flash_error', \Yii::t('all', 'Error in saving Localization'));
                }
            }

            if($ok){
                // Invalidate caches after localization update
                $this->invalidateCategoryCaches();

                \Yii::$app->getSession()->setFlash('flash_success', \Yii::t('all', 'Localization added'));
            }
            return $this->redirect(['index']);
        }

        return $this->renderAjax('/localization/category', [
            'langModels' => $langModels,
            'itemModel' => $itemModel,
        ]);
    }


    /**
     * Store cache key for later invalidation using Redis sets
     */
    private function storeCacheKey($key)
    {
        $setKey = self::CACHE_PREFIX . 'keys';

        if (Yii::$app->has('redis')) {
            Yii::$app->redis->sadd($setKey, $key);
        }
    }


    /**
     * Invalidate all category caches
     * @return int Number of keys deleted
     */
    private function invalidateCategoryCaches()
    {
        $deleted = 0;

        if (Yii::$app->has('redis')) {
            $setKey = self::CACHE_PREFIX . 'keys';

            // Get all keys from the set
            $keys = Yii::$app->redis->smembers($setKey);

            // Delete each cache key
            foreach ($keys as $key) {
                if (Yii::$app->cache->delete($key)) {
                    $deleted++;
                }
            }

            // Clear the set
            Yii::$app->redis->del($setKey);

            Yii::info("Invalidated {$deleted} category cache keys", 'redis');
        }

        return $deleted;
    }

}