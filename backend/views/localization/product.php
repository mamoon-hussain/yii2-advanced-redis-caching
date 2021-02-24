<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Area */

$this->title = \Yii::t('all', 'Localization');
$this->params['breadcrumbs'][] = ['label' => Yii::t('all', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = \Yii::t('all', 'Localization');
?>
<div class="modal-header">
    <h4 class="modal-title white" id="myModalLabel11">
        <?= $this->title ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?= \Yii::t('all', 'Close') ?>">
            <span aria-hidden="true">×</span>
        </button>
    </h4>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
<div class="card">
    <div class="card-content">
        <ul class="nav nav-justified nav-tabs nav-tabs-material" id="justifiedTab" role="tablist">
            <?php
            $active = 'active';
            foreach ($langModels as $Lang => $oneLangModel){ ?>
                <li class="nav-item">
                    <a aria-controls="<?= $Lang ?>" aria-selected="true"
                       class="nav-link waves-effect waves-dark <?= $active ?>"
                       data-toggle="tab" href="#<?= $Lang ?>" id="<?= $Lang ?>-tab" role="tab">
                        <?= Yii::t('all', $Lang. ' Localization') ?>
                    </a>
                </li>
                <?php
                $active = '';
            } ?>
        </ul>
        <div class="card-body">
            <div class="tab-content" id="justifiedTabContent">
                <?php
                $active = 'active';
                foreach ($langModels as $Lang => $oneLangModel){ ?>
                    <div aria-labelledby="<?= $Lang ?>-tab" class="tab-pane fade <?= $active ?> show" id="<?= $Lang ?>"
                         role="tabpanel">
                        <div class="form-group">
                            <?= $form->field($oneLangModel, 'name',
                                [
                                    'selectors' => [
                                        'input' => '#'.$Lang.'-name',
                                        'container' => '#'.$Lang.'-container',
                                    ],
                                    'options' => ['id' => $Lang.'-container'],
                                ])->textInput([
                                'name'=> $Lang.'_LocalizedProduct[name]',
                                'id'=>$Lang.'-name'])->label(Yii::t('all', 'Name', [], $Lang));  ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($oneLangModel, 'small_description',
                                [
                                    'selectors' => [
                                        'input' => '#'.$Lang.'-small_description',
                                        'container' => '#'.$Lang.'-container',
                                    ],
                                    'options' => ['id' => $Lang.'-container'],
                                ])->textarea([
                                'rows' => '6',
                                'name'=> $Lang.'_LocalizedProduct[small_description]',
                                'id'=>$Lang.'-small_description'
                            ])->label(Yii::t('all', 'Small Description', [], $Lang));  ?>
                        </div>

                        <div class="form-group">
                            <?= $form->field($oneLangModel, 'description',
                                [
                                    'selectors' => [
                                        'input' => '#'.$Lang.'-description',
                                        'container' => '#'.$Lang.'-container',
                                    ],
                                    'options' => ['id' => $Lang.'-container'],
                                ])->widget(\dosamigos\tinymce\TinyMce::className(), [
                                'options' => [
                                    'rows' => 4,
                                    'name'=> $Lang.'_LocalizedProduct[description]',
                                    'id'=>$Lang.'-description',
                                ],
                                'language' => api_lang(),
                                'clientOptions' => tinymceClientOptions()
                            ])->label(Yii::t('all', 'Description', [], $Lang));  ?>
                        </div>


                    </div>
                    <?php
                    $active = '';
                } ?>
            </div>

        </div>
    </div>
</div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?= Html::submitButton(\Yii::t('all', 'Save'), ['class' => 'btn btn-primary', 'style' => 'color: white']) ?>
    <button type="button" class="btn btn-warning" data-dismiss="modal" style="color: white; margin: 0% 1%;">
        <?= \Yii::t('all', 'Close') ?>
    </button>
</div>
<?php ActiveForm::end(); ?>











