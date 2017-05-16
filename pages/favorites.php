<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>AAMO</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<section id="home">

		<div id="navbar_container">
			<div id="navbar_left">
				<a href="home.php"><img id="logo" src="../img/header/graphic.jpg"></a>
			</div>
			<div id="navbar_background"></div>
			<div id="navbar_right">
				<ul>
					<li><a id="aboutButton" href="about.php">ABOUT</a></li>
					<li><a id="productsButton" href="products.php">PRODUCTS</a></li>
					<li> <a onclick="document.getElementById('loginclick').style.display='block'">LOGOUT</a>
						<div id='loginclick' class='modal'>
							<div onclick='document.getElementById(\"loginclick\").style.display=\"none\"' class='close'>&times;</div>
							<!-- Modal Content -->
							<form class='loginform' action='favorites.php' method='post'>
								<label><b>Logged in as $logged_user</b></label><br/>
								<button type='submit' class='loginbtn'>LOGOUT</button>
							</form>                 
						</div>
					</li>
					<?php
					require_once 'config.php';
					$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
					if (isset($_POST['loginbtn'])) {
						unset($_SESSION['logged_user'] );
						unset( $_SESSION );
						$_SESSION = array();
						session_destroy();
						header("Location: home.php");
						die();
					}
					?>     
					<script>
						var modal = document.getElementById('loginclick');
						window.onclick = function(event) {
							if (event.target == modal) {
								modal.style.display = "none";
							}
						}
					</script>
					<li><a href="favorites.php">FAV</li>
				</ul> 
			</div>
		</div>

		<div id="favContent">
			<?php
			require_once 'config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ($mysqli->errno) {
				print($mysqli->error);
				exit();
			}
			$username= $_SESSION['logged_user'];
			$sqlUser="SELECT * FROM Users WHERE username= $username";
			$userall=$mysqli->query("$sqlUser");
			$userrow=$userall->fetch_assoc();
			$userID=$userrow['userID'];

			$sqlFavs = "SELECT * FROM Favorited INNER JOIN Products ON Products.productID=Favorited.productID WHERE link.userID=$userID";
			$result=$mysqli->query("$sqlFavs");
			$count=$results->num_rows;

			if (!($count>=1)){
				echo'<h2> You have not favorited any items </h2>';
			} else {
            //Display all favorited products   
				print( '<ul class="item_list_thumb">' );
				while ($row = $result->fetch_assoc()) {
					print'<li><a href="products.php?productID='.$row["productID"].'" class="item_image_thumb"><img src="'.$row[ "filePath" ].'" alt="'.$row[ "name" ].'""/><!--Image Source:Aayusha Shrestha--><br/>
						<a href="albums.php?delete_productID='.$row[ "productID" ].'">Delete</a>';
				}
				print('</ul>');

				if(isset($_GET['delete_productID'])) {
					$delete_productID=$_GET['delete_productID'];
					$sqlD = "DELETE FROM Favorited WHERE productID ='".$delete_productID."'and userID='".$userID."'";
					($mysqli->query($sqlD));
					if ( $mysqli->errno) {
						print($mysqli->error);
						exit();
					}
				}
			}	
			?>
		</div>


		<div id="footer">
			<ul>
                <!-- <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank" ><img src="../img/socialmediaicon/facebookblack.png" onmouseover="this.src='../img/socialmediaicon/facebookgold.png'" onmouseout="this.src='../img/socialmediaicon/facebookblack.png'"></a></li>
                <li><a href="https://www.instagram.com/aamo_nepal/?hl=en" target="_blank"><img src="../img/socialmediaicon/instablack.png" onmouseover="this.src='../img/socialmediaicon/instagold.png'" onmouseout="this.src='../img/socialmediaicon/instablack.png'"></a></li> -->
                <li> AAMO by Aayusha Shrestha || Kathmandu, Nepal || +977-9849121844 </li>
                <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank">FACEBOOK</a></li>
                <li><a href="https://www.instagram.com/aamo_nepal/?hl=en" target="_blank">INSTAGRAM</a></li>
                <li><a id="contactButton" href="contact.php">EMAIL</a></li>
            </ul> 
        </div>
    </section>
</body>
</html>

