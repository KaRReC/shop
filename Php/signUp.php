<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";
	echo "<div class='orderForms'>";

?>

<form action="doSignUp.php" method="POST" >
	<input type="text" name="login" placeholder="Login">
	<input type="password" name="password" placeholder="Password">
	<input type="submit"value="Sign ">
</form>

<?php	

	echo "</div></div></div>";

	include('includes/footer.php');


?>