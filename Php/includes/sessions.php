<?php 

	class session{

		private $id;
		private $ip;
		private $browser;
		private $time;
		private $user;
		private $salt;
		
		public function __construct(){
			global $conn, $request;

			if(!isset($_COOKIE[SESSION_COOKIE])){
				$_COOKIE[SESSION_COOKIE] = '';
			}
			else{
				if(strlen($_COOKIE[SESSION_COOKIE]) != SESSION_ID_LENGHT){
					$this->newSession();
				}
			}

			$sql = $conn->prepare('SELECT session_id, updated_at, salt_token, user_id, uniq_info, ip, browser FROM sessions WHERE session_id = :sid AND uniq_info = :info AND updated_at > :updated AND ip = :ip AND browser = :browser');

			$sql->bindValue(':sid', $_COOKIE[SESSION_COOKIE], PDO::PARAM_STR);
			$sql->bindValue(':updated', time() - SESSION_COOKIE_EXPIRE, PDO::PARAM_INT);
			$sql->bindValue(':info', $request->getInfo(), PDO::PARAM_STR );
			$sql->bindValue(':ip', $request->getIp(), PDO::PARAM_STR);
			$sql->bindValue(':browser', $request->getBrowser(), PDO::PARAM_STR);
			$sql->execute();

			if ($session = $sql -> fetch(PDO::FETCH_ASSOC)) {
				$sql -> closeCursor();
				$this->id = $_COOKIE[SESSION_COOKIE];
				$this->salt = $session['salt_token'];
				$this->ip = $session['ip'];
				$this->browser = $session['browser'];
				$this->time = $session['updated_at'];

				setcookie(SESSION_COOKIE, $this->id, time() + SESSION_COOKIE_EXPIRE);

				$sql = $conn->prepare('UPDATE sessions SET updated_at = :time WHERE session_id = :sid');
				$sql->bindValue(':sid', $_COOKIE[SESSION_COOKIE], PDO::PARAM_STR);
				$sql->bindValue(':time', time(), PDO::PARAM_INT);
				$sql->execute();

				if ($session['user_id'] != 0) {
					$sql = $conn->prepare("SELECT login FROM users WHERE id = :uid");
					$sql->bindValue(':uid', $session['user_id'], PDO::PARAM_INT);
					$sql->execute();

					$row = $sql->fetchAll(PDO::FETCH_ASSOC);
					$this->user = new user;
					$this->user->setLogin($row[0]['login']);
					$this->user->setId($session['user_id']);
				}
				else{
					$this->user = new user(true);
				}
			}
			else{
				$sql->closeCursor();
				$this->newSession();
			}
		}

		function newSession(){
			global $conn, $request;

			$this->id = random_session_id();
			$this->salt = random_salt(10);
			setcookie(SESSION_COOKIE, $this->id, time() + SESSION_COOKIE_EXPIRE);

			$sql = $conn->prepare('INSERT INTO sessions (session_id, updated_at, salt_token, user_id, uniq_info, browser, ip) VALUES (:session_id, :time, :salt, :user_id, :info, :browser, :ip)');
			$sql->bindValue(':session_id', $this->id, PDO::PARAM_STR);
			$sql->bindValue(':time', time(), PDO::PARAM_INT);
			$sql->bindValue(':salt', $this->salt, PDO::PARAM_STR);
			$sql->bindValue(':user_id', 0, PDO::PARAM_INT);
			$sql->bindValue(':info', $request->getInfo(), PDO::PARAM_STR);
			$sql->bindValue(':browser', $request->getBrowser(), PDO::PARAM_STR);
			$sql->bindValue(':ip', $request->getIp(), PDO::PARAM_STR);
			$sql->execute();
			$this->user = new user(true);
		}

		function updateSession(user $user){
			global $conn, $request;

			$newId = random_session_id();
			$newSalt = random_salt(10);
			setcookie(SESSION_COOKIE, $newId, time() + SESSION_COOKIE_EXPIRE);

			$sql = $conn->prepare("UPDATE sessions SET salt_token = :salt, updated_at = :time, session_id = :newId, user_id = :uid WHERE session_id = :sid");
			$sql->bindValue(':salt', $newSalt, PDO::PARAM_STR);
			$sql->bindValue(':time', time(), PDO::PARAM_INT);
			$sql->bindValue(':newId', $newId, PDO::PARAM_STR);
			$sql->bindValue(':uid', $user->getId(), PDO::PARAM_INT);
			$sql->bindValue(':sid', $this->id, PDO::PARAM_STR);
			$sql->execute();

			$this->id = $newId;
			$this->user = $user;
		}

		public function getSessionId(){
			return $this->id;
		}

		public function getUser(){
			return $this->user;
		}
	}

 ?>
