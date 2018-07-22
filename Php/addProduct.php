<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";
	echo "<div class='orderForms'>";

	if ($session->getUser()->isUser()) {
		echo "<form action='doAddProduct.php' method='POST'>"; 
		echo "<input type='text' name='Pindex' placeholder='Product index' required>";
		echo "<input type='text' name='name' placeholder='Product name' required>";
		echo "<input type='text' name='price' placeholder='Product price' required>";
		echo "<textarea name='description' placeholder='Product description' required></textarea>";
		

		$sql = $conn->prepare("SELECT * FROM categories");
		$sql->execute();

		$rows = $sql->fetchALL(PDO::FETCH_ASSOC);
		echo "<p>Product category</p>";
		echo "<select name='category'>";
		foreach ($rows as $category) {
			$id = $category['id'];
			$name = $category['name'];
			echo "<option value='$id'>$name</option>";
		}
		echo "</select>";
		echo "<input type='submit' value='Add Product'>";
		echo "</form>";
	}
	
	echo "</div></div></div>";

	include('includes/footer.php');


?>