<?php 

	class cart{
		
		public function __construct(){
			
		}

		public function add($id){
			global $conn, $session;

			$sql = $conn->prepare("INSERT INTO sessioncart (id, session_id, product_id, quantity) VALUES (null, :sid, :pid, 1)");
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->bindValue(':pid', $id, PDO::PARAM_INT);
			$sql->execute();
		}

		public function getProducts(){
			global $conn, $session;

			$sql = $conn->prepare("SELECT * FROM sessioncart s LEFT OUTER JOIN products p ON (s.product_id = p.id) WHERE session_id = :sid");
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

	}

?>