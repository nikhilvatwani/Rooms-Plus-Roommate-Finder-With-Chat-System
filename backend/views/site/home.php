<!DOCTYPE html>
<html>
	<head>
	<style>
		#ChatBig{width:500px;height:450px ;border:1px solid #000;margin:auto;}
		#ChatMessages{width:500px;height: 400px;}
		#ChatText{width:495px;height:48px;border-bottom: 1px solid #333;}
	</style>
	<link href="style/style.css">
		<script type="text/javascript" src="../views/site/js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#ChatText').keyup(function(e){
					if(e.keyCode ==13){
						//alert('hi');
						var ChatText = $('#ChatText').val();
						$.ajax({
							type:'POST',
							url:'http://localhost/advaced/backend/web/index.php?r=site/insert-message&id='+<?php echo $id?>,
							data:{ChatText:ChatText},
							success:function(){
								$('#ChatMessages').load('http://localhost/advaced/backend/web/index.php?r=site/display-messages&id='+<?php echo $id?>);
								$('#ChatText').val('');
							}
						})

					}
				});
				setInterval(function(){
					$('#ChatMessages').load('http://localhost/advaced/backend/web/index.php?r=site/display-messages&id='+<?php echo $id?>);
				},1500);

				$('#ChatMessages').load('http://localhost/advaced/backend/web/index.php?r=site/display-messages&id='+<?php echo $id?>);
			});
		</script>
	</head>
	<body>
		<h2>Welcome <?php echo Yii::$app->session['username']?></h2>
		<div id="ChatBig"  style="height:auto;width:auto">
			<div id="ChatMessages"  style="height:auto;width:auto">
			</div>
			<textarea id="ChatText">
			</textarea>
		</div>
	</body>
</html>