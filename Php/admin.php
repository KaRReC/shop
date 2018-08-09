<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

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
			echo "<h3>Wellcome,</h3>";
			echo "<h4>You are log as:</h4><h3>".$session->getUser()->getLogin()."<h/3><br><br>";

			echo "<a href='addProduct.php'><input type='submit' value='Add Product'></a>";
			}
		}
	}

	echo "</div></div></div>";

	include('includes/footer.php');

?>
