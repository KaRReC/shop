<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";

	$cart->remove($_GET['id']);
	header('Location: showcart.php');

	echo "</div></div>";

	include('includes/footer.php');


?>
