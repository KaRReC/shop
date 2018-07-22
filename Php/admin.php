<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";
	echo "<div class='orderForms'>";

	if ($session->getUser()->isAnonymous()) {
		include('includes/login.php');
	}
	else{
		if($session->getUser()->isAdmin()){
			echo "Wellcome, Admin";
			echo "<br><br>";

			echo "<a href='addProduct.php'>Add Product</a>";
		}
		else{
			if($session->getUser()->isUser()){
			echo "Wellcome,<br>";
			echo "You are log as:<br><br>".$session->getUser()->getLogin();
			echo "<br><br>";

			echo "<a href='addProduct.php'><input type='submit' value='Add Product'></a>";
			}
		}
	}

	echo "</div></div></div>";

	include('includes/footer.php');


?>