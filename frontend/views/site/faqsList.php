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


<section class="container">
    <div id="<?= 'faq_'.$model->id ?>" class="accordion-container">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#<?= 'faq_cll'.$model->id ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= ($model ->question) ?>
                    </button>
                </h5>
            </div>

            <div id="<?= 'faq_cll'.$model->id ?>" class="collapse " aria-labelledby="headingOne" data-parent="<?= 'faq_'.$model->id ?>">
                <div class="card-body">
                    <?= ($model ->answer) ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
if(($index+1) %3==0){
    echo "<div class='clearfix'></div>";
}

?>
