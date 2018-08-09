<?php	

	define('SESSION_COOKIE', 'cookieshop');
	define('SESSION_ID_LENGHT', 40);
	define('SESSION_COOKIE_EXPIRE', 3600);

	function showNavbar(){
		global $conn, $session;

		echo "<span><a class='navbar' href='admin.php'>Log in</a></span>";
		if (!$session->getUser()->isAnonymous()) {
			echo "<span><a class='navbar' href='logout.php'>Logout</a></span>";
		}

		echo "<span><a class='navbar' href='showcart.php'><i class='fa fa-shopping-cart' style='font-size:30px;'></i> Cart</a></span>";
	}

	function showMenu(){
		global $conn, $session;
		$sql = $conn->prepare("SELECT * FROM categories");
		$sql -> execute();

		echo "<a href='index.php'>Main site</a>";

		while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
			$name = $row['name'];
			$id = $row['id'];
			
			echo "<a href='index.php?cat_id=$id'>$name</a>";
		}
	}

	function showMenu2(){
		global $conn, $session;
		$sql = $conn->prepare("SELECT * FROM categories");
		$sql -> execute();

		echo "<div class='categories'>";
		echo "<a href='index.php'><p>Main site</p></a>";

		while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
			$name = $row['name'];
			$id = $row['id'];
			
			echo "<a href='index.php?cat_id=$id'><p>$name</p></a>";
		}
		
		echo "</div>";
	}

	function showCategory($category_id = null){
		global $conn;

		if ($category_id) {
			$sql = $conn->prepare("SELECT * FROM products WHERE category_id = :cid");
			$sql -> bindValue(':cid', $category_id, PDO::PARAM_INT);
			$sql -> execute();

			while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
				$Pindex = $row['Pindex'];
				$id = $row['id'];
				echo "<div class='row'>";
				echo "<div class='photo'>";
				echo "<a href='products.php?id=$id'>";
				$Img = pictures($Pindex);
				if (!empty($Img)) {
					$photo = $Img[0];
				}
				else{
					$photo = 'no-photo.jpg';
				}
				echo "<img src='../Img/Thumbs/$photo'>";
				echo "</div><div class='nameANDprice'>";
				echo "<h4>".$row['name']."</h4>";
				echo "</a>"; 
				echo "Price: ".$row['price']." &#x20AC";
				echo "</div>";
				echo "</div>";
			}
		}
		else{
			$sql = $conn->prepare("SELECT * FROM products");
			$sql -> execute();

			
			while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
				$Pindex = $row['Pindex'];
				$id = $row['id'];
				echo "<div class='row'>";
				echo "<div class='photo'>";
				echo "<a href='products.php?id=$id'>";
				$Img = pictures($Pindex);
				if (!empty($Img)) {
					$photo = $Img[0];
				}
				else{
					$photo = 'no-photo.jpg';
				}
				echo "<img src='../Img/Thumbs/$photo'>";
				echo "</div><div class='nameANDprice'>";
				echo "<h4>".$row['name']."</h4>";
				echo "</a>"; 
				echo "Price: ".$row['price']." &#x20AC";
				echo "</div>";
				echo "</div>";
			}

		}
	}

	function pictures($Pindex) {
		$Img = array();
		
		for ($i=0; $i < 10 ; $i++) { 
			$filename = $Pindex."-".$i.".jpg";
			$filepath = "../Img/$filename";
			if (file_exists($filepath)) {
				$Img[] = $filename;
			}
		}
		return $Img;
	}

	function random_session_id(){
		$utime = time();
		$id = random_salt(40-strlen($utime)). $utime;
		return $id;
	}

	function random_salt($len){
		return random_text($len);
	} 

	function random_text($len){
		$base = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
		$max = strlen($base)-1;
		$rstring = '';
		mt_srand((double)microtime()*1000000);
		while (strlen($rstring) < $len) 
			$rstring.= $base[mt_rand(0, $max)];
			return $rstring;
		
	}

?>
