<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RoomsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'no_of_rooms') ?>

    <?= $form->field($model, 'rent') ?>

    <?= $form->field($model, 'flat_no') ?>

    <?php // echo $form->field($model, 'building_name') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'interested') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
