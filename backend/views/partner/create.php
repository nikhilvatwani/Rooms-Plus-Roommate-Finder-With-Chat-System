<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Partner */

$this->title = 'Create Partner';
?>
<div class="partner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelRooms' => $modelRooms,
        'modelUpload'=>$modelUpload,
    ]) ?>

</div>
