<?php
	class user{
		private $UserId,$UserName,$UserPassword,$UserRole;

		public function getUserId(){
			return $this->UserId;
		}
		public function setUserId($UserId){
			$this->UserId = $UserId;
		}
		public function getUserName(){
			return $this->UserName;
		}
		public function setUserName($UserName){
			$this->UserName = $UserName;
			//var_dump($this->$ChatUserId);
		}
		public function getUserPassword(){
			return $this->UserPassword;
		}
		public function setUserPassword($UserPassword){
			$this->UserPassword = $UserPassword;
		}
		public function getUserRole(){
			return $this->UserRole;
		}
		public function setUserRole($UserRole){
			$this->UserRole = $UserRole;
		}

	}


	class chat{
		private $ChatId,$ChatUserId,$ChatText;

		public function getChatId(){
			return $this->ChatId;
		}
		public function setChatId($ChatId){
			$this->ChatId = $ChatId;
		}
		public function getChatUserId(){
			return $this->ChatUserId;
		}
		public function setChatUserId($ChatUserId){
			$this->ChatUserId = $ChatUserId;
			//var_dump($this->$ChatUserId);
		}
		public function getChatText(){
			return $this->ChatText;
		}
		public function setChatText($ChatText){
			$this->ChatText = $ChatText;
		}

		public function insertChatMessage($id){
			include 'conn.php';
			$req = $conn->prepare("INSERT INTO chat (ChatUserId,ChatText) VALUES(:ChatUserId,:ChatText)");

			$req->execute(array('ChatUserId'=>$this->getChatUserId(),'ChatText'=>$this->getChatText()));
			$idLast = $conn->lastInsertId();
			$C = $conn->prepare("SELECT * FROM message WHERE id = ".$id);
			$C->execute();
			while($d = $C->fetch()){
				//var_dump("UPDATE message SET chat_id = '".$d['chat_id'].','.$idLast."' WHERE id =".$id);
				//die();
				$r = $conn->prepare("UPDATE message SET chat_id = '".$d['chat_id'].','.$idLast."' WHERE id =".$id);

				$r->execute();
			}
		}

		public function DisplayMessage($data){
			include 'conn.php';
			$ChatReq = $conn->prepare("SELECT * FROM chat WHERE ChatId IN (".$data.")ORDER BY ChatId ASC");
			$ChatReq->execute();

			while($DataChat = $ChatReq->fetch()){
				$UserReq = $conn->prepare('SELECT * FROM credintials WHERE id=:UserId');
				$UserReq->execute(array(
					'UserId'=>$DataChat['ChatUserId']
					));
				$DataUser = $UserReq->fetch();
				?>
				<span class="UserNameS" style="color:red;font-weight:bold"><?php echo $DataUser['username']?> says: </span><br>
				<span class="ChatMessageS" style="color:blue"><?php echo $DataChat['ChatText']?></span><br>
				<hr>
				<?php
			}
		}
	}

?>