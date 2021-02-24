<?php
use yii\helpers\Html;
?>

<div class="row one-content" id="contentContainer<?= $id ?>"  data-id="<?= $id ?>">

    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <button class="delete-con btn btn-sm btn-danger" data-id="<?= $id ?>"><?= '<i class="fa fa-times"></i>' ?></button>
                <?php
//                stopv($model);
                if($model->isNewRecord) {
                    echo '<input style="display: none" name="content['. $id.'][id]" value="'. $model->id.'">';
                }
                echo '<label class="control-label">'. $model->getAttributeLabel(t('Content')). '</label>';
                echo Html::input('text',
                    'content['.$id.'][content]',
                    $model->content,
                    $options = [
                        'class' => 'form-control',
                        'style' => ''
                    ]) ;
                ?>
            </div>
        </div>
    </div>
</div>

