<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Pjax;
use yii\widgets\ListView;
?>



<div class="col mb-4">
    <a href="<?= Yii::$app->urlManager->createUrl("tools/tool-details?id=".$model->id) ?>">
        <div class="card text-white h-100">
            <img src="<?=$model->imageUrl ?>" class="card-img-top" alt="Sketch Books">
            <div class="card-img-overlay bg-dark" style="top: 60%; opacity: 0.75; bottom: 15px;">
                <h5 class="card-title text-center" style="line-height: 0%;"><?= $model->name ?></h5>
            </div>
        </div>
    </a>
</div>



<!---->
<!---->
<?php
//if(($index) %3==0 && $index !== 0){
//    echo "<div class='clearfix'></div>";
//}
//
//?>

