<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu();

	echo "<div class='products'>";

	echo "<table>";

	$inCart = $cart->getProducts();

	echo "<tr><td>Index</td><td>Name</td><td>Price</td><td>Quantity</td><td>Total price</td></tr>";

	$sum = 0;
	foreach ($inCart as $product) {
		$price = $product['price'];
		$quantity = $product['quantity'];
		$Pindex = $product['Pindex'];
		$name = $product['name'];
		$total = $quantity * $price;
		$sum+= $total;
		echo "<tr><td>$Pindex</td><td>$name</td><td>$price</td><td>$quantity</td><td>$total &#x20AC</td></tr>";

	}

	echo "</table>";

	echo "<h3 id='sum'>".$sum." &#x20AC</h3>";

	echo "</div></div>";

	include('includes/footer.php');


?>


