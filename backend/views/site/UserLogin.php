<?php
	session_start();
	include 'conn.php';

	if(isset($_POST['uname']) && isset($_POST['psw'])){
		$req = $conn->prepare('SELECT * FROM credintials WHERE username=:username AND password=:password');
		$req->execute(array('username'=>$_POST['uname'],'password'=>$_POST['psw']));
		if($req->rowCount() == 0){

		}else{

			while($data = $req->fetch()){
				$_SESSION['username'] = $data['username'];
				$_SESSION['role'] = $data['role'];
				if($data['role'] == 10)
					$_SESSION['c_id'] = $data['foreign_id'];
				elseif ($data['role'] == 20) {
					$_SESSION['p_id'] = $data['foreign_id'];
				}
				$_SESSION['UserId'] = $data['id'];
			}
			header("Location: home.php");
		}
	}
?>