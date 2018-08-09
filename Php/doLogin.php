<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";
	echo "<div class='orderForms'>";

	if ($session -> getUser() -> isAnonymous()) {
		$result = user::checkPasswords($_POST['login'], $_POST['password']);
		if ($result instanceof user) {
			$session->updateSession($result);
			header('Location: admin.php');
		}
		else{
			
			echo "<a href='admin.php'><input type='submit' value='Try again to log in'></a>";
			
		}
		
	}

	echo "</div></div></div>";

	include('includes/footer.php');


?>
