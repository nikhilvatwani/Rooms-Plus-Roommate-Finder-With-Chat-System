<?php
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style type="text/css">
	body{
		background-image: url("../uploads/bg.jpg");
		background-size: 210vh 100vh;
    	background-repeat: no-repeat;
	}
	.tp{
		margin-top:15%;
	}
</style>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="tp">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-3">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'password')->passwordInput() ?>
		</div>
		<div class="col-md-3">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<?php
				if(isset($err1))
					echo "<p style='color:red'>".$err1."</p>";
			?>
		</div>
		<div class="col-md-3">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			    <div class="form-group">
			        <?= Html::submitButton('Log In',['class'=>'btn btn-warning']) ?>
			    </div>
		</div>
		<div class="col-md-3">
		</div>
	</div>
</div>
    <?php ActiveForm::end(); ?>