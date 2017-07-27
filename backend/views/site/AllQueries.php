<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            margin-right:8%;
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
  <script type="text/javascript">
  	function clear(ref){
  		var id = $(ref).attr('id');
  		alert(id);
  		$.ajax({
            type:"GET",
            url:"http://localhost/advaced/backend/web/index.php?r=site/clearquery&q="+id,
            success:function(msg){
            	alert(msg);
              }
          })
  	}
  </script>
</head>
<body>

<div class="container">          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Clear</th>
      </tr>
    </thead>
    <tbody>
     <?php
		foreach ($data as $key => $value) {
	?>
		<tr>
			<td><?php echo $value['name']?></td>
			<td><?php echo $value['email']?></td>
			<td><?php echo $value['subject']?></td>
			<td><?php echo $value['message']?></td>
			<td><button class="btn" id="<?php echo $value['id']?>" onclick="clear(this)">clear</button></td>
		</tr>
	<?php
		}
	 ?>
    </tbody>
  </table>
</div>

</body>
</html>

