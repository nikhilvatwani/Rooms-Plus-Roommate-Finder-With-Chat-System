<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partner */

$this->title = 'Update Partner: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelRooms' => $modelRooms,
    ]) ?>

</div>
