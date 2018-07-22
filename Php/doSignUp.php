<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";

	$login = $_POST['login'];
	$password = $_POST['password'];

	$sql = $conn->prepare("SELECT * FROM users WHERE login = :login");
	$sql->bindValue(':login', $login, PDO::PARAM_STR);
	$sql->execute();

	if ($row = $sql->fetchAll(PDO::FETCH_ASSOC)){

		echo "<div class='orderForms'>";
		echo "login exists, please try else<br>";
?>

<form action="#" method="POST">
	<input type="text" name="login" placeholder="Login">
	<input type="password" name="password" placeholder="Password">
	<input type="submit"value="Sign ">
</form>

<?php	
		echo "</div>";
	}
	else{

	$sql = $conn->prepare("INSERT INTO users (id, login, password) VALUES (null, :login, :password)");
	$sql->bindValue(':login', $login, PDO::PARAM_STR);
	$sql->bindValue(':password', $password, PDO::PARAM_STR);
	$sql->execute();

	echo "<div class='orderForms'>";

    echo "New account created successfully<br>";

    echo "You can now log in<br>";
    echo "<a href='admin.php'>Log in</a>";
	}

	echo "</div></div></div>";

	include('includes/footer.php');


?>