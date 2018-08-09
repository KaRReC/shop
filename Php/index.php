
<?php

	include('includes/header.php');
	
?>


<div class="content">


	
<?php

	showMenu2();

	echo "<div class='products'>";

	if (isset($_GET['cat_id'])) {
		$category_id = $_GET['cat_id'];
	}
	else{
		$category_id = null;
	}
	showCategory($category_id);
	echo "</div>";
	
?>
</div>
<?php 

	include('includes/footer.php');

?>
