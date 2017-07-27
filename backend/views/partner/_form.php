<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use backend\models\Country;
/* @var $this yii\web\View */
/* @var $model backend\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
        if($model->isNewRecord)
            echo  $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelRooms, 'type')->dropDownList(['1'=>'house','2'=>'flat']) ?>

    <?= $form->field($modelRooms, 'no_of_rooms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelRooms, 'rent')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-6">
    <?= $form->field($modelRooms, 'flat_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelRooms, 'building_name')->textInput(['maxlength' => true]) ?>

    <?php
    	$countries = ArrayHelper::map(Country::find()->asArray()->all(),'id','name');
    	echo $form->field($modelRooms, 'country')->dropDownList($countries, ['id'=>'cat-id']); 
    ?>

    <?php 
    	echo $form->field($modelRooms, 'state')->widget(DepDrop::classname(), [
												    'options'=>['id'=>'subcat-id'],
												    'pluginOptions'=>[
												        'depends'=>['cat-id'],
												        'placeholder'=>'Select...',
												        'url'=>Url::to(['/partner/subcat'])
												    ]
												]);
	?>

    <?= $form->field($modelRooms, 'area')->widget(DepDrop::classname(), [
												    'pluginOptions'=>[
												        'depends'=>['cat-id', 'subcat-id'],
												        'placeholder'=>'Select...',
												        'url'=>Url::to(['/partner/prod'])
												    ]
												]); 
	?>

    <?= $form->field($modelRooms, 'description')->textArea(['maxlength' => true]) ?>

    <?php
        if($model->isNewRecord)
            echo $form->field($modelUpload, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
