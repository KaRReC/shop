<?php

	include('includes/header.php');
	
	echo "<div class='content'>";

	showMenu2();
	
	function showProduct($id){
		global $conn;

		$sql = $conn->prepare("SELECT * FROM products WHERE id = :id");
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->execute();

		while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
		
		$id = $row['id'];
		$Pindex = $row['Pindex'];
		echo "<div class='products'>";
		

		foreach (pictures($Pindex) as $Img) {	
					
			echo "<div class='photo'><a data-lightbox='[$Pindex]' href='../Img/$Img'><img src='../Img/Thumbs/$Img'></a></div>";
				}
				echo "<div class='nameANDprice'>";
				echo "<h2>".$row['name']."</h2>";
				echo "<h3>Price: ".$row['price']." &#x20AC</h3>";
				echo "<a id='addToCart' href='addToCart.php?id=$id'>Add product</a>";
				echo "<h4>Description:</h4>".$row['description'];
				echo "</div>";
				echo "</div>";
				echo "</div>";
				
			}	
	}

	if(isset($_GET['id'])) {
		showProduct($_GET['id']);
	}

	include('includes/footer.php');


?>
