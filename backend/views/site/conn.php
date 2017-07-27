<?php
	try{
		$conn = new PDO("mysql:host=localhost;dbname=rooms","root","");
	}catch(Exception $e){
		die('cannot connect');
	}
?>