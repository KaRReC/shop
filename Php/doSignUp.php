<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";

	$login = $_POST['login'];
	$password = $_POST['password'];
	$hash = password_hash($password, PASSWORD_DEFAULT);

	$sql = $conn->prepare("SELECT * FROM users WHERE login = :login");
	$sql->bindValue(':login', $login, PDO::PARAM_STR);
	$sql->execute();

	if ($row = $sql->fetchAll(PDO::FETCH_ASSOC)){

		echo "<div class='orderForms'>";
		echo "<p>Login exists, please try else one</p>";
?>

<form action="#" method="POST">
	<input type="text" name="login" placeholder="Login">
	<input type="password" name="password" placeholder="Password">
	<input type="submit" value="Sign up">
</form>

<?php	
		echo "</div>";
	}
	else{

	$sql = $conn->prepare("INSERT INTO users (id, login, password) VALUES (null, :login, :password)");
	$sql->bindValue(':login', $login, PDO::PARAM_STR);
	$sql->bindValue(':password', $hash, PDO::PARAM_STR);
	$sql->execute();

	echo "<div class='orderForms'>";

    echo "New account created successfully<br>";

    echo "You can now log in<br>";
    echo "<a href='admin.php'>Log in</a>";
	}

	echo "</div></div></div>";

	include('includes/footer.php');


?>
