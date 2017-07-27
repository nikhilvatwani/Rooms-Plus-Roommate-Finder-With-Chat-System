<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?php
                if ($model->isNewRecord)
                    echo $form->field($model, 'password')->passwordInput();
            ?>

            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'occupation')->dropDownlist(['1'=>'professional','2'=>'student']);
             ?>

            <?= $form->field($model, 'age')->textInput() ?>

            <?= $form->field($model, 'gender')->dropDownlist(['1'=>'female','2'=>'male']); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
