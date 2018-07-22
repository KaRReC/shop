<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";

	$session -> updateSession(new user(true));
	header("Location: index.php");

	echo "</div></div>";

	include('includes/footer.php');


?>