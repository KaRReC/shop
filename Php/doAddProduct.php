<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";
	echo "<div class='orderForms'>";

	if ($session->getUser()->isUser()) {
		$Pindex = $_POST['Pindex'];
		$name = $_POST['name'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$category_id = $_POST['category'];

		$sql = $conn->prepare("INSERT INTO products (id, Pindex, name, price, description, category_id) VALUES (null, :Pindex, :name, :price, :description, :category_id)");
		$sql->bindValue(':Pindex', $Pindex, PDO::PARAM_STR);
		$sql->bindValue(':name', $name, PDO::PARAM_STR);
		$sql->bindValue(':price', $price, PDO::PARAM_STR);
		$sql->bindValue(':description', $description, PDO::PARAM_STR);
		$sql->bindValue(':category_id', $category_id, PDO::PARAM_INT);
		$sql->execute();

		header('Location: admin.php');
	
	}
	

	echo "</div></div></div>";

	include('includes/footer.php');


?>
