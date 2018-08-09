<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";
	
	$sql = $conn->prepare("INSERT INTO orders (id, customer, address, email) VALUES (null, :customer, :address, :email)");
	$sql->bindValue(':customer', $_POST['customer'], PDO::PARAM_STR);
	$sql->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
	$sql->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
	$sql->execute();

	$orderId = $conn->lastInsertId();
	
	$orderedProducts = $cart->getProducts();

	foreach ($orderedProducts as $product) {
		$pid = $product['pid'];
		$qty = $product['quantity'];

		$sql = $conn->prepare("INSERT INTO ordersproducts (id, order_id, product_id, quantity) VALUES (null, :orderId, :pid, :qty)");
		$sql->bindValue(':orderId', $orderId, PDO::PARAM_INT);
		$sql->bindValue(':pid', $pid, PDO::PARAM_INT);
		$sql->bindValue(':qty', $qty,PDO::PARAM_INT);
		$sql->execute();
	}

	$cart->clear();
	
	echo "<h1>Thank you for placing your order</h1>";
	echo "</div></div>";

	// email function doesn't work without emailserver
	
	//mail($_POST['email'], "Order number: $orderId", "Confirmation of order");

	include('includes/footer.php');


?>
