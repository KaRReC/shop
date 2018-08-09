<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

	echo "<div class='products'>";

	echo "<h2>Content of your shopping cart:</h2>";

	echo "<table>";

	$inCart = $cart->getProducts();

	echo "<tr><th>Index</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total price</th></tr>";

	$sum = 0;
	foreach ($inCart as $product) {
		$productCartId = $product['id'];
		$price = $product['price'];
		$quantity = $product['quantity'];
		$Pindex = $product['Pindex'];
		$name = $product['name'];
		$total = $quantity * $price;
		$id = $product['pid'];
		$sum+= $total;

		$remove = "<a href='remFromCart.php?id=$productCartId'>Remove</a>";
		$plus = "<a id='plus' href='addToCart.php?id=$id'> + </a>";
		$minus = "<a id='minus' href='remFromCart.php?id=$id'> - </a>";

		echo "<tr><td>$Pindex</td><td>$name</td><td>$price &#x20AC </td><td> $minus $quantity $plus </b></h1></td><td>$total &#x20AC</td></tr>";


	}
	echo "<tr><td></td><td></td><td></td><td></td><td><h3>$sum &#x20AC</h3></td></tr>";
	echo "</table>";

	if ($cart->getProducts()) {
		echo "<div class='order'>";
		echo "<a href='order.php'><input type='submit' value='Order'></a>";
		echo "</div>";
		
	}

	echo "</div></div>";

	include('includes/footer.php');


?>


