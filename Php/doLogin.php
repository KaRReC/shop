<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";

	if ($session -> getUser() -> isAnonymous()) {
		$result = user::checkPasswords($_POST['login'], $_POST['password']);
		if ($result instanceof user) {
			$session->updateSession($result);
			header('Location: admin.php');
		}
		else{
			echo "<div class='orderForms'>";
			echo "not such user";
			echo "</div>";
		}
		
	}

	echo "</div></div>";

	include('includes/footer.php');


?>