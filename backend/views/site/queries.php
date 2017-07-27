<?php
try{
		$con=mysqli_connect("localhost","root","","rooms");
	}catch(Exception $e){
		die('cannot connect');
	}
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	mysqli_query($con,"INSERT INTO queries(name,email,subject,message) VALUES ('$name','$email','$subject','$message')");
	header('Location:http://localhost/advaced/home/thankyou.html');
?>