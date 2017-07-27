<?php
	use backend\models\Country;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  	function depState(){
  		$('.state').empty();
  		$('.area').empty();
          $.ajax({
            type:"GET",
            url:"http://localhost/advaced/backend/web/index.php?r=site/getstate&state="+$('.country').val(),
            success:function(msg){
            	data = eval(msg);
                $(data).each(function(key,value){
                	$('.state').append('<option value='+value['id']+'>'+value['name']+'</option>');
                });
                $('.country').addClass('clicked');
                if($('.state').hasClass('clicked'))
					$('.state').removeClass("clicked");
				if($('.area').hasClass('clicked'))
					$('.area').removeClass("clicked");
                add();

              }
          })
      }
      function depArea(){
  		$('.area').empty();
          $.ajax({
            type:"GET",
            url:"http://localhost/advaced/backend/web/index.php?r=site/getarea&area="+$('.state').val(),
            success:function(msg){
            	data = eval(msg);
                $(data).each(function(key,value){
                	$('.area').append('<option value='+value['id']+'>'+value['name']+'</option>');
                });
                $('.state').addClass('clicked');
                if($('.area').hasClass('clicked'))
					$('.area').removeClass("clicked");
                add();
              }
          })
      }
      function onlyArea(){
      	$('.area').addClass('clicked');
      	add();
      }
  </script>
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
        .navbar-right{
            margin-right:10%;
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
</head>
<body>
<?php
	$country = Country::find()->asArray()->all();
?>
	<div class="row">
		<div class="col-md-5">
<div id="div">
<div class="div">
<span class="diff">Select Country :</span>
<select class="country" onchange="depState()">
<?php
	foreach ($country as $key => $value) {
?>
		<option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
<?php
	}
?>
</select>
<br>
<span class="diff">Select State :</span>
<select class="state" onchange="depArea()">
</select>
<br>
<span class="diff">Select Area :</span>
<select class="area" onchange="onlyArea()">
</select>
</div>
<div class="div">
<span class="diff">Rent per week($) :</span><br><br>
<input type="text" name="rent" placeholder="Min" id="min" class="minrent" size="10"></input>
<input type="text" name="rent" placeholder="Max" id="max" class="maxrent" size="10"></input>
<p class="err" style="color:red"></p>
</div>
<span class="diff">Choose property type :</span><br><br>
<div class="div">
<button id="button1" value="2" class="type">Flat</button>
<button id="button2" value="1" class="type">House</button>
</div>
<span class="diff">Bedrooms available :</span><br><br>
<div class="div">
<button id="button3" value="1" class="no_of_rooms">1</button>
<button id="button4" value="2" class="no_of_rooms">2</button>
<button id="button5" value="3" class="no_of_rooms">3</button>
<button id="button6" value="4" class="no_of_rooms">4</button>
</div><br>
<span class="diff">Flatmate Age Range :</span><br><br>
<div class="div">
<input type="number" name="age" placeholder="Min" id="minage" class="minage" size="10"></input>
<input type="number" name="age" placeholder="Max" id="maxage" class="maxage" size="10"></input>
<p class="err1"></p>
</div>
<span class="diff">Flatmate Gender :</span><br><br>
<div class="div">
<button id="button7" value="2" class="gender">Male</button>
<button id="button8" value="1" class="gender">Female</button>
</div>
<span class="diff">Flatmate Occupation :</span><br><br>
<div class="div">
<button id="button9" value="2" class="occupation">Student</button>
<button id="button10" value="1" class="occupation">Professional</button>
</div>

</div>
		</div>
		<div class="col-md-7" id="result">
			<?php
        foreach ($info as $key => $value) {
      ?>  <a href="http://localhost/advaced/backend/web/index.php?r=site/slider&room_id=<?php echo $value['id']?>"><div class="unique"><img src='<?php echo $value['images']?>' height="100%" width="40%" class="uniqueimg"><div class="rent">$<?php echo $value['rent']?></div><div class="address">Address:<?php echo $value['flat_no']?>,<?php echo $value['building_name']?>,<br><?php echo $value['area']?>,<?php echo $value['state']?>,<?php echo $value['country']?></div><div class="description"><?php echo $value['description']?></div></div></a><br>
      <?php
        }
      ?>
		</div>
	</div>
<script type="text/javascript" src="search.js"></script>
</body>
</html>
