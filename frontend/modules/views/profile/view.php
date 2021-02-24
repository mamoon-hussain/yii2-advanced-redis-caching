<?php
use yii\widgets\DetailView;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\ZUser $model
 */
$this->title = t('Profile');

$this->params['breadcrumbs'][] = $this->title;
?>
<?php // echo $this->render('_shared_head'); ?>


<section class="header10 cid-si3gh69yvp mbr-fullscreen" id="header10-7" style="background-image: url('<?= imageUrl('/mbr-1920x1281.jpg') ?>');">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?= $this->title ?></strong></h1>
            </div>
        </div>
    </div>
</section>


<div class="" style="padding: 0 5%;margin-top:50px">
    <div class="mx-auto " style="     margin-bottom: 25px">

        <div class="container" >
            <div class="row">
                <div class="col-12 col-md-12 align-center col-lg-12" style="">
                    <div class="plan mb-4" style="border-radius: 20px; background-color: #c2c2c2;">
                        <div class="plan-header pt-3">
                            <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                                <strong><?= $model->fullName ?></strong>
                            </h6>
                        </div>
                        <div class="plan-body">
                            <div class="plan-list mb-3">
                                <?=
                                DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'fname',
                                        'lname',
                                        'email',
                                        'phone',
                                    ],

                                ])
                                ?>
                            </div>
                            <div class="mbr-section-btn text-center">
                                <?= Html::a(t('Edit'), ['update', 'id' => $model->id], [
                                    'class' => 'btn btn-success display-4',
                                ]) ?>
                                <?= Html::a(t('Change Password'), ['change-own-password'], [
                                    'class' => 'btn btn-primary display-4',
                                ]) ?>
                                <a class="btn btn-warning display-4" style=""
                                   href="<?= Yii::$app->urlManager->createUrl("/user/auth/logout") ?>"><?= t('Logout')?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>

<style>
    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
        color: black;
    }
    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        background-color: #ffffff;
        background-image: linear-gradient(var(--bs-table-accent-bg),var(--bs-table-accent-bg));
        border-bottom-width: 1px;
    }
</style>

