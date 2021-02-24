<?php

use yii\helpers\Html;


?>


    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?= "fuck" ?></h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('changeFrame', [
                'model' => $model,
                'frames' => $frames,
            ]) ?>

        </div>
    </div>
<?php
