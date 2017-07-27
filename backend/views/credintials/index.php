<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CredintialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Credintials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credintials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Credintials', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            'role',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
