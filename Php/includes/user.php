<?php 

	class user{
		
		private $id;
		private $login;
		private $construct;

		function __construct($anonymous = true){
			if ($anonymous == true) {
				$this->id = 0;
				$this->login = '';
			}
			$this->construct = true;
		}

		public function setLogin($login){
			$this->login = $login;
		}

		public function getLogin(){
			return $this->login;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function isAnonymous(){
			return ($this->id == 0);
		}

		public function isAdmin (){
			return ($this->id == 1);
		}
		public function isUser (){
			return ($this->id != 0);
		}

		public function checkPasswords($login, $password){
			global $conn, $request;

			$sql = $conn->prepare("SELECT id,  login FROM users WHERE login = :login AND password = :password");
			$sql->bindValue(':login', $login, PDO::PARAM_STR);
			$sql->bindValue(':password', $password, PDO::PARAM_STR);
			$sql->execute();

			if ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
				$newUser = new user;
				$newUser->setId($row[0]['id']);
				$newUser->login = $row[0]['login'];

				return $newUser;
			}
			else{
				return 0;
			}
		}
	}

?>
