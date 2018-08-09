<?php 

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();

?>

<div class="products">
	<div class="orderForms">
		<form action="orderSummary.php" method="POST">
			<input type="text" name="customer" placeholder="Enter your name" required>
			<textarea name="address" placeholder="Your address with post code" required></textarea>
			<input type="email" name="email" placeholder='Enter your email' required>
			<input id="agree" type="submit" value="I agree">
		</form>
	</div>
</div>

<?php

	echo "</div>";

	include('includes/footer.php');


?>
