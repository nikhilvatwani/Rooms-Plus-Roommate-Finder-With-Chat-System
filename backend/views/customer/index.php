<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    var loc = "/advaced/backend/web/index.php?r=site%2Fcustomer";
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
            margin-right:8%;
        }
</style>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'contact_no',
            'occupation',
            // 'age',
            // 'gender',
            // 'interested',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
