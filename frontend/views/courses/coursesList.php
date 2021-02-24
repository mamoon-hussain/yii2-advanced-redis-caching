

<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
//stopv($model);
?>



    <div class="underlay" >
        <div class="card">
            <div class="card-img-top" style="background-image: url('<?= imageURL('place_images/'.$model->image) ?>'); background-repeat: no-repeat ; background-size: contain"></div>
            <div class="card-block" >
                <h5 class="card-title" style="font-family: 'Anton', sans-serif">
                    <a href="<?= Yii::$app->urlManager->createUrl("courses/course-details?id=".$model->id) ?>" ><?= $model->name ?></a><hr></h5>
                <p class="card-text">The brown Sennheiser HD 598 audiophile headphones have excellent, detailed hi-fi sound and a stylish design. They are comfortable to wear and offer versatility as well. These accessories feature a multi-dimensional soundstage
                    <a href="<?= Yii::$app->urlManager->createUrl("courses/course-details?id=".$model->id) ?>" ><u>Read More...</u></a></p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>


    <!---->
    <!---->
<?php
//if(($index) %3==0 && $index !== 0){
//    echo "<div class='clearfix'></div>";
//}
//
//?>

