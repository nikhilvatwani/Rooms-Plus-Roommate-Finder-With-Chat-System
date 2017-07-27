<?php
	include 'classes.php';
	if(isset($_POST['ChatText'])){
		$chat = new chat();
		$chat->setChatUserId(Yii::$app->session['UserId']);
		$chat->setChatText($_POST['ChatText']);
		$chat->insertChatMessage($id);
	}
?>