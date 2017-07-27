<?php
	include 'classes.php';
	var_dump($_POST['msg']);
	die();
	if(isset($_POST['msg'])){
		$chat = new chat();
		$chat->setChatUserId(Yii::$app->session['UserId']);
		$chat->setChatText($_POST['msg']);
		$chat->insertChatMessage();
	}
?>