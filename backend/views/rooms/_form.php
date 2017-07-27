<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'no_of_rooms')->textInput() ?>

    <?= $form->field($model, 'rent')->textInput() ?>

    <?= $form->field($model, 'flat_no')->textInput() ?>

    <?= $form->field($model, 'building_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images')->textInput() ?>

    <?= $form->field($model, 'interested')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
