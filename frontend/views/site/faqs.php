

<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = t(Yii::$app->params['title']);
$this->params['breadcrumbs'][] = $this->title;

?>

<header class="masthead" >
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center" style="margin: 0 !important; width: 100%;">
            <?php
            Pjax::begin(['id' => 'faqs']);
            echo ListView::widget([
                'dataProvider' => $faqsDataProvider,
                'itemView' => 'faqslist',
                'layout' => "{items}\n <div class='clearfix'></div> <div class='text-center'>{pager}</div> "
            ]);
            Pjax::end();
            ?>

        </div>
    </div>
</header>


