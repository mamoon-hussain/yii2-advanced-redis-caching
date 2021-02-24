<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\BaseUrl;

DashboardAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
    <body class="">
        <?php $this->beginBody() ?>
        <section class="content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </section>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

