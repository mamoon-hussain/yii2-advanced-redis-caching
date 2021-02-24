<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <?= nl2br(Html::encode($message)) ?>
                            </div>
                            <p>
                                <?= Yii::t('all', 'The above error occurred while the Web server was processing your request.') ?>
                            </p>
                            <p>
                                <?= Yii::t('all', 'Please contact us if you think this is a server error. Thank you.') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






