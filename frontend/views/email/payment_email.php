<?php
use common\models\Supermarket;

?>
<?php
echo $this->render('_email_header');
?>
<?= t('Dear Admin') ?>,<br/><br/>
<?= t('A successful payment was made for Request #') . $model->id ?>,
    <br/>
    <hr />


