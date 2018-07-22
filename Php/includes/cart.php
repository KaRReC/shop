<?php 

	class cart{
		
		public function __construct(){
			
		}

		public function add($id){
			global $conn, $session;

			$sql = $conn->prepare("SELECT * FROM sessioncart WHERE product_id = :id AND session_id = :sid");
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->execute();

			if($row = $sql->fetchAll(PDO::FETCH_ASSOC)){
				$qty = $row[0]['quantity'] + 1;

				$sql = $conn->prepare("UPDATE sessioncart SET quantity = :qty WHERE session_id = :sid AND product_id = :pid");
				$sql->bindValue('qty', $qty, PDO::PARAM_INT);
				$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
				$sql->bindValue(':pid', $id, PDO::PARAM_INT);
				$sql->execute();
			}
			else{

				$sql = $conn->prepare("INSERT INTO sessioncart (id, session_id, product_id, quantity) VALUES (null, :sid, :pid, 1)");
				$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
				$sql->bindValue(':pid', $id, PDO::PARAM_INT);
				$sql->execute();
			}
		}

		public function remove($id){
			global $conn, $session;

			$sql = $conn->prepare("SELECT * FROM sessioncart WHERE	product_id = :id AND session_id = :sid");
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			$row = $sql->fetchAll(PDO::FETCH_ASSOC);
			$qty = $row[0]['quantity'];
			$qty--;

			if ($qty == 0) {
				$sql = $conn->prepare("DELETE FROM sessioncart WHERE product_id = :id AND session_id = :sid");
				$sql->bindValue(':id', $id, PDO::PARAM_INT);
				$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
				$sql->execute();
			}
			else{
				$sql = $conn->prepare("UPDATE sessioncart SET quantity = :qty WHERE product_id = :id AND session_id = :sid");
				$sql->bindValue(':id', $id, PDO::PARAM_INT);
				$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
				$sql->bindValue(':qty', $qty, PDO::PARAM_INT);
				$sql->execute();
			}
		}

		public function getProducts(){
			global $conn, $session;

			$sql = $conn->prepare("SELECT s.id, p.price, s.quantity, p.Pindex, p.name, p.id as pid FROM sessioncart s LEFT OUTER JOIN products p ON (s.product_id = p.id) WHERE session_id = :sid");
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function clear(){
			global $conn, $session;

			$sql = $conn->prepare("DELETE FROM sessioncart WHERE session_id = :sid");
			$sql->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$sql->execute();
		}
	}

?>
