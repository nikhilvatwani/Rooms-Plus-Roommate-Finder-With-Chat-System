<?php

use backend\models\Country;
use backend\models\State;
use backend\models\Area;
use backend\models\Customer;
use backend\models\Partner;
/* @var $this yii\web\View */
/* @var $model backend\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php
    	$images = [];
    	$i = 0;
    	if (is_dir($model->images)){
                  if ($dh = opendir($model->images)){
                    while (($file = readdir($dh)) !== false){
                        if($file!='.'&&$file!='..'&&$file!='Thumbs.db')
                        {    $images[$i++] = $model->images.'/'.$file;
                        }
                    }
                    closedir($dh);
                  }
                }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>

  .carousel .item {
  	height: 500px;
	}

	.item img {
	    position: absolute;
	    top: 0;
	    left: 0;
	    min-height: 100%;
	}
	#myCarousel{
		height:15%;
		width:60%;
	}
	.rent{
		background-color:#C58065;
		color:white;
		width:60%;
		margin-left:3px;
    border-radius:15px;
	}
	.about{
		background-color:#C58065;
		color:white;
		width:60%;
		margin-left:3px;
    border-radius:15px;
    height:70%;
	}
  .owner-info{
    background-color:#C58065;
    color:white;
    width:60%;
    margin-left:3px;
    border-radius:15px;
    margin-top: 2%;
  }
	.address{
		margin-left:20px;
	}	
	.interested-people{
		background-color: #C58065;
		color:white;
		border-radius:15px;
		padding:15px;
		font-weight:bold;
	}
  </style>
  <style type="text/css">
    .navbar-inverse{
            background-color: white;
            border-color:white;
        }
    .navbar-inverse .navbar-nav > li > a{
            color : black;
            font-size:15px;
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
            margin-top: -5px;
        }
        .navbar-inverse .navbar-nav > li > a:hover{
            background-color:#9E3A3A; 
        }
        .navbar-inverse .navbar-nav > .active > a{
            background-color:#9E3A3A;
        }
        .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover{
            background-color:#9E3A3A; 
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
        }

  </style>
  <script>
  	function interested(room_id){
  	$.ajax({
		 type: "GET",
		 url: "http://localhost/advaced/backend/web/index.php?r=site%2Finterested&q=" + room_id,
		 contentType: "application/json; charset=utf-8",
		 dataType: "json",
		 success: function(msg) {
		 }
		});
  	$('#abc').addClass('disabled');
  	$('#abc').text('INTERESTED');
  	}
  </script>
  <style type="text/css">
  .navbar-right{
            margin-right:8%;
        }
</style>
</head>
<body>
<div class="row">
<div class="col-md-8">
<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php
    	foreach ($images as $key => $value) {
    		if($key == 0){
    ?>
    			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

    <?php
    		}else{
    ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>"></li>
     <?php
    		}
    	}
    ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
     <?php
    	foreach ($images as $key => $value) {
    		if($key == 0){
    ?>
      <div class="item active">
        <img src="<?php echo $value; ?>" width="100%" height="100%">
      </div>
    <?php
    		}else{
    ?>
       <div class="item">
        <img src="<?php echo $value; ?>" width="100%" height="100%">
      </div>
     <?php
    		}
    	}
    ?>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <br>
  	<div class="row rent">
		<h2 class="col-md-4">RENT : </h2><h3 class="col-md-1"><?php echo $model->rent; ?></h3>
	</div>
	<?php
			$country = Country::findOne(['id'=>$model->country]);
            $state = State::findOne(['id'=>$model->state]);
            $area = Area::findOne(['id'=>$model->area]);
            if($model->type == 1)
            	$type = 'House';
            else
            	$type = 'Flat';
	?>
	<div class="about">
		<h3>About the flat :</h3>
				<p><h4>&emsp;Type : <?php echo $type; ?></h4></p>
				<p><h4>&emsp;Address :</h4></p>
				<div class="address">
					<p>&emsp;Building :<?php echo $model->flat_no; ?>,<?php echo $model->building_name; ?></p>
					<p>&emsp;Area :<?php echo $area->name; ?></p>
					<p>&emsp;State :<?php echo $state->name; ?></p>
					<p>&emsp;Country :<?php echo $country->name; ?></p>
				</div>
				<p><h4>&emsp;Number of Rooms : <?php echo $model->no_of_rooms; ?></h4></p>
				<p><h4>&emsp;Description :</h4></p>
				<p>&emsp;&emsp;<?php echo $model->description; ?></p>
	</div>
  <?php 
  $owner = Partner::findOne(['room_id'=>$model->id]);
?>
<div class="row owner-info">
  <div class="container">
    <h2>Owner Details:</h2>
    &emsp;Name : <?php echo $owner->name?>
    <br>
    &emsp;E-mail : <?php echo $owner->email?>
  </div>
</div>
</div>
<br>
<br>
</div>
<?php
	$modelCustomer = Customer::findOne(['id'=>Yii::$app->session['customer']]);
  $f = 0;
	if($modelCustomer->interested != NULL)
	{	
		$temp = explode(',', $modelCustomer->interested);
        foreach ($temp as $key => $value) {
            if($value == $model->id)
                $f = 1;
        }
      }
?>
<div class="col-md-4">
	<div class="cotainer">

	<?php
		if($f == 1){
	?>
 		<button type="button" class="btn btn-warning btn-block disabled">INTERESTED</button>
 	<?php
		}else{
	?>
		<button type="button" class="btn btn-warning btn-block" id="abc" onclick="interested(<?php echo $model->id?>)">INTERESTED?</button>
	<?php		
		}
	?>
  <?php
  if($model->interested != NULL)
  { 

  ?>
      <p><h2>Interested People : </h2></p>
  <?php
    $temp = explode(',', $model->interested);
        $f = 0;
        $i=0;
        $interested_people = [];
        foreach ($temp as $key => $value) {
            if($value != Yii::$app->session['customer']){
                $modelCustomer = Customer::findOne(['id'=>$value]);
    ?>
      <div class="interested-people">
        <p>Name : <?php echo $modelCustomer->name ?></p>
        <p>Occupation : <?php
        $occupation = NULL;
        if($modelCustomer->occupation == 1)
          $occupation = 'Proffesional';
        else
          $occupation = 'Student';
          echo $occupation ?></p>
        <p>Age : <?php echo $modelCustomer->age ?></p>
        <p>Gender : <?php 
          $gender = NULL;
        if($modelCustomer->gender == 1)
          $gender = 'Female';
        else
          $gender = 'Male';
          echo $gender ?></p>
      </div>
      <br>
    <?php
            }
        }
    }
  ?>
 	</div>
</div>
 </div>
</body>
</html>
