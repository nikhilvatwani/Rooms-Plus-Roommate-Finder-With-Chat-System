<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rooms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'no_of_rooms',
            'rent',
            'flat_no',
            // 'building_name',
            // 'country',
            // 'state',
            // 'area',
            // 'description',
            // 'images',
            // 'interested',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
