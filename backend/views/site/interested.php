<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<style>
		.unique{
    background-color: #da9276;
    height:200px;
    opacity:1;
    border-radius:15px;
}
.uniqueimg{
    border-radius:15px;
    opacity:0.8;
}
.unique:hover{
    box-shadow: 10px 10px 5px #C58065;
}
.rent{
    height:70px;
    width: 100px;
    position:relative;
    margin-top:-200px;
    border-radius:15px;
    background-color: grey;
    color:white;
    padding-left:18px;
    padding-top:10px;
    font-size: 30px;
    opacity:0.7;
}
.navbar-right{
            margin-right:10%;
        }
.address{
    float:right;
    margin-right:15px;
    margin-top:-50px;
    font-size:115%;
    font:weight:bold;
}
.description{
    float:right;
    font-size:100%;
    margin-left: 45%;
}
	.interested-people{
		background-color: #a75050;
		color:white;
		border-radius:15px;
		padding:15px;
		font-weight:bold;
		font-size:120%;
		display:inline-block;
		height:300px;
		padding:80px;
		border:5px solid #381d1d;
	}
	</style>
</head>
<body>
 
<div id="result">
	<?php
	if($data != NULL){
		foreach ($data as $key => $value) {
			if(Yii::$app->session['role'] == 10){
	
	?>
			<a href="http://localhost/advaced/backend/web/index.php?r=site/slider&room_id=<?php echo $value['id']?>"><div class="unique"><img src='<?php echo $value['images']?>' height="100%" width="40%" class="uniqueimg"><div class="rent">$<?php echo $value['rent']?></div><div class="address">Address:value['flat_no']<?php echo $value['flat_no']?>,<?php echo $value['building_name']?>,<?php echo $value['area']?>,<?php echo $value['state']?>,<?php echo $value['country']?></div><div class="description"><?php echo $value['description']?></div></div></a><br>
	<?php
			}else if(Yii::$app->session['role'] == 20){
	?>
				      <div class="interested-people">
				        <p>Name : <?php echo $value['name'] ?></p>
				        <p>Occupation : <?php
				        $occupation = NULL;
				        if($value['occupation'] == 1)
				          $occupation = 'Proffesional';
				        else if($value['occupation'] == 2)
				          $occupation = 'Student';
				          echo $occupation ?></p>
				        <p>Age : <?php echo $value['age'] ?></p>
				        <p>Gender : <?php 
				          $gender = NULL;
				        if($value['gender'] == 1)
				          $gender = 'Female';
				        else if($value['gender'] == 2)
				          $gender = 'Male';
				          echo $gender ?></p>
				          <p>Email:<?php echo $value['email']?></p>
				      </div>
	<?php			
			}
		}
	}else{
		?>
		<p><h1>No Activity Yet</h1></p>
	<?php
		
	}
	?>
</div>

</body>
</html>