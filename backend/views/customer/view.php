<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = $model->name;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    var loc = "/advaced/backend/web/index.php?r=site%2Fview";
    //alert(loc.indexOf("/advaced/backend/web/index.php?r=customer%2Findex"));
    $('.navbar-inverse .navbar-nav > li').each(function() {
        var link = $(this).find('a:first').attr('href');
        //alert(loc);
        //alert(link);
        if(loc.indexOf(link) >= 0){
            $(this).addClass('active');
        }
    });
});
</script>
<style type="text/css">
    .navbar-right{
            margin-right:10%;
        }
</style>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'email:email',
            'contact_no',
            'occupation',
            'age',
            'gender',
        ],
    ]) ?>

</div>
