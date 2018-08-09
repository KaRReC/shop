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

			$sql = $conn->prepare("SELECT * FROM users WHERE login = :login");
			$sql->bindValue(':login', $login, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				if (password_verify($_POST['password'], $row['password'])) {
					$newUser = new user;
					$newUser->setId($row['id']);
					$newUser->login = $row['login'];

					return $newUser;
				}
				else{
					echo "<h3>Password invalid</h3>";
				}
			}
			else{
				echo "<h3>There is no such user</h3>";
			}
		}
	}

?>
