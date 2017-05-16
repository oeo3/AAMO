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

		<div id="homeSlide">
			<div id='scroll_home'>
				<script type="text/javascript">
					$(function(){
						$('a[href*=#homecontent]').on('click', function(e) {
							e.preventDefault();
							$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800, 'linear');
							$('#scroll_home').hide();
						});
					});
				</script>
				<a href="#homecontent"><span></span></a>
			</div>
		</div>

		<script type="text/javascript">
			$(window).load(function() {           
				var i =0; 
				var images = ['../img/home_slideshow/cuffs.jpg','../img/home_slideshow/workman.jpg'];
				var image = $('#homeSlide');
				setInterval(function(){         
					image.fadeOut(1000, function () {
						image.css('background', 'url(' + images [i++] +') no-repeat 50% 70%' );
						image.css('background-size', 'cover');
						image.fadeIn(1000);
					});
					if(i == images.length) {
						i = 0;
					}
				}, 5000);            
			});
		</script>


		<div id="navbar_container">
			<div id="navbar_left">
				<a href="home.php"><img id="logo" src="../img/header/graphic.jpg"></a>
			</div>
			<div id="navbar_background"></div>
			<div id="navbar_right">
				<ul>
					<li><a id="aboutButton" href="about.php">ABOUT</a></li>
					<li><a id="productsButton" href="products.php">PRODUCTS</a></li>
					<li> <a onclick="document.getElementById('loginclick').style.display='block'">

						<!-- Logged in or not -->
						<?php
						if (isset($_SESSION['logged_user'])) {
							$logged_user = $_SESSION['logged_user'];
							echo "LOGOUT</a>";
							echo "<div id='loginclick' class='modal'>";
							echo "<div onclick='document.getElementById(\"loginclick\").style.display=\"none\"' class='close'>&times;</div>";
                            //<!-- Modal Content -->
							echo "<form class='loginform' action='home.php' method='post'>";
							echo "<label><b>Logged in as $logged_user</b></label>";
							echo "<button type='submit' class='loginbtn'>LOGOUT</button>";
							echo "</form>";                 
							echo "</div>"; 
						} 
						else {
							echo "LOGIN</a>";
                            //<!-- The Modal -->
							echo "<div id='loginclick' class='modal'>";
							echo "<div onclick='document.getElementById(\"loginclick\").style.display=\"none\"' class='close'>&times;</div>";
                            //<!-- Modal Content -->
							echo "<form class='loginform' action='home.php' method='post'>";
							echo "<label><b>Username</b></label><br/>";
							echo "<input type='text' placeholder='Enter Username' name='username' required><br/>";
							echo "<label><b>Password</b></label><br/>";
							echo "<input type='password' placeholder='Enter Password' name='psw' required><br/>";
							echo "<button type='submit' class='loginbtn'>LOGIN</button>";
							echo "</form>"; 
							echo "<a href='#' type='submit' class='forgotpsw' onclick='document.getElementById(\"signupclick\").style.display=\"none\"; document.getElementById(\"loginclick\").style.display=\"none\"; document.getElementById(\"forgotpass\").style.display=\"block\"'> Forgot password?</a><br/>";
							echo "<a href='#' type='submit' class='signupbtn' onclick='document.getElementById(\"signupclick\").style.display=\"block\"; document.getElementById(\"loginclick\").style.display=\"none\"; document.getElementById(\"forgotpass\").style.display=\"none\"'>Don't have an account? SIGN UP!</button><br/>";  

							echo "</div>"; 
						}


						require 'config.php';
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

						if (isset($_POST['loginbtn'])) {
							if (isset($_SESSION['logged_user'])) {
								unset($_SESSION["logged_user"] );
								unset( $_SESSION );
								$_SESSION = array();
								session_destroy();
								header("Refresh:0");
							}
							else {
								$username = htmlentities($_POST['username']);
								$psw = htmlentities($_POST['psw']);

								$result = $mysqli->query("SELECT * from Users WHERE username = '$username'");
								$row = $result->fetch_assoc();
								$correctp = $row['password'];

								$valid_password = password_verify("$psw", $correctp);        

								if ($valid_password && $username === $row['username']) {
									$_SESSION['logged_user'] = $username;
                                    //"Successfully logged in as $username!"

								} 
								else {
                                    //"Log in failed!"
								}   
								header("Refresh:0");
							}
						}
						?>     

						<script>
							var modal = document.getElementById('loginclick');
							window.onclick = function(event) {
								if (event.target == modal) {
									modal.style.display = "none";
								}
							}
							var modal2 = document.getElementById('signupclick');
							window.onclick = function(event) {
								if (event.target == modal2) {
									modal2.style.display = "none";
								}
							}

							var modal3 = document.getElementById('forgotpass');
							window.onclick = function(event) {
								if (event.target == modal3) {
									modal3.style.display = "none";
								}
							}
						</script>

						<!--Sign up form validation -->
						<?php
						require 'config.php';
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						if ( isset($_POST['signup']) ) {

							$name = trim($_POST['signupname']);
							$name = strip_tags($name);
							$name = htmlspecialchars($name);

							$username = trim($_POST['signupusername']);
							$username = strip_tags($username);
							$username = htmlspecialchars($username);

							$email = trim($_POST['signupemail']);
							$email = strip_tags($email);
							$email = htmlspecialchars($email);

							$pass = trim($_POST['signuppsw']);
							$pass = strip_tags($pass);
							$pass = htmlspecialchars($pass);

							$repass= trim($_POST['pswrepeat']);
							$repass = strip_tags($repass);
							$repass = htmlspecialchars($repass);

							if (!empty($pass) && !empty($repass)) {
								if ($pass!=$repass) {
									$error=true;
									$passError="Repeated password does not match.";
								}
							}

							if (empty($name)) {
								$error = true;
								$nameError = "Please enter your name.";
							} else if (strlen($name) < 3) {
								$error = true;
								$nameError = "Name must have atleat 3 characters.";
							} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
								$error = true;
								$nameError = "Name must contain alphabets and space.";
							}

							if (empty($username)) {
								$error = true;
								$usernameError = "Please enter a username.";
							} else if (!preg_match ("/^[a-z0-9_-]{3,16}$/",$username)){
								$error=true;
								$usernameError="Username must be between 3 and 16 characters long and can only have alphabets, numbers, underscore and hyphen.";
							} else {
								$query = "SELECT username FROM users WHERE username='$username'";
								$result = mysql_query($query);
								$count = mysql_num_rows($result);
								if($count!=0){
									$error = true;
									$usernameError = "Provided username is already in use.";
								}
							}

							if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
								$error = true;
								$emailError = "Please enter valid email address.";
							} else {
   							// check email exist or not
								$query2 = "SELECT email FROM users WHERE email='$email'";
								$result2 = mysql_query($query2);
								$count = mysql_num_rows($result2);
								if($count!=0){
									$error = true;
									$emailError = "The email is already in use.";
								}
							}

  							// password validation
							if (empty($pass)){
								$error = true;
								$passError = "Please enter password.";
							} else if(strlen($pass) < 6) {
								$error = true;
								$passError = "Password must have atleast 6 characters.";
							}


  							// encrypt password 
							$password = hash('sha256', $pass);

  							// if there's no error, continue to signup
							if( !$error ) {
								$query3 = "INSERT INTO users(username,password,name,email) VALUES('$username','$name','$password', '$email')";
								$res = mysql_query($query3);

								if ($res) {
									$errTyp = "success";
									$errMSG = "Sign up was successfully.";
									unset($name);
									unset($username);
									unset($pass);
								} else {
									$errTyp = "danger";
									$errMSG = "There was an error. Please sign up again."; 
								}  
							} 
						}					

						?>
						<!-- Modal Content -->
						<div id='signupclick' class='modal2'></a>
							<div onclick='document.getElementById("signupclick").style.display="none"' class='close'>&times;</div>
							<?php
							if (isset($errMSG)) {
								?>
								<div class="error">
									<?php echo $errMSG; ?>
								</div>
								<?php
							}
							?>

							<!-- Modal2 Content -->
							<form class='signupform' action='home.php' method='post'>
								<label><b>Name</b></label><br/>
								<input type='text' placeholder='Enter Name' name='signupname' required><br/>

								<span class="error"><?php echo $nameError; ?></span>

								<label><b>Username</b></label><br/>
								<input type='text' placeholder='Enter Username' name='signupusername' required><br/>

								<span class="error"><?php echo $usernameError; ?></span>

								<label><b>Email</b></label><br/>
								<input type='text' placeholder='Enter Email' name='signupuemail' required><br/>

								<span class="error"><?php echo $emailError; ?></span>

								<label><b>Password</b></label><br/>
								<input type='password' placeholder='Enter Password' name='signuppsw' required><br/>

								<span class="error"><?php echo $passError; ?></span>

								<label><b>Repeat Password</b></label><br/>
								<input type="password" placeholder="Repeat Password" name="pswrepeat" required>
								<button type='submit' class='signup'>SIGN UP</button>   
							</form>
						</div> 
						<?php
						require_once 'config.php';
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						if (isset($_POST["resetRequest"])) {
							if (filter_var($_POST["resetemail"], FILTER_VALIDATE_EMAIL)) {
								$resetemail = $_POST["resetemail"];

							}else{
								echo "email is not valid";
								exit;
							}

							$query = "SELECT id FROM users where email='".$email."'";
							$result = mysqli_query($mysqli,$query);
							$resultsRow = mysqli_fetch_array($result);

							if(count($Results)>=1){
								$message = "Your password reset link send to your e-mail address.";
								$to=$email;
								$subject="Forget Password";
								$from = 'aamo website';
								$body='Hi'.$resultsRow['name'].', <br/> <br/>Your username is '.$Results['username'].' <br><br>Click <a href="reset.php?username='.$Results['username'].'&action=reset">here</a> to reset your password.<br/>';
								$headers = "From: " . strip_tags($from) . "\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								mail($to,$subject,$body,$headers);
							}
							else
							{
								$message = "Account not found please signup now!!";
							}
						}

						?>
						<!--Modal3 Content-->
						<div id="forgotpass" class="modal3">
							<div onclick='document.getElementById("forgotpass").style.display="none"' class='close'>&times;</div>
							<form class="forgotpassform" action="home.php" method="post">
								<label><b>Email Address</b></label><br/>
								<input type='text' placeholder='Enter Name' name='resetemail' required><br/>
								<button type='submit' class='resetRequest'>RESET PASSWORD</button>   
							</form>
						</div>
					</li>
					<li><a href="favorites.php">FAV</li>
					<li><a href="reset.php?username=nora&action=reset">reset</li>
				</ul> 

			</div>
		</div>


		<div id="homecontent">
			<div id="home_left">
				<ul>
					<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
					<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
					<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
					<li><a id="cat_jewel" href="products.php"> JEWELERY</a></li>
					<li><a id="cat_wood" href="products.php">WOOD WORK</a></li>
					<li><a id="cat_textiles" href="products.php">TEXTILES</a></li>
				</ul>
			</div>
			<div id="home_right">
				<!--Pseudocode to display google calendar: -->
				<iframe src="https://calendar.google.com/calendar/embed?src=oeo3%40cornell.edu&ctz=America/New_York" style="border: 0" frameborder="0" scrolling="no"></iframe>

				<!--scroll arrow-->
				<script type="text/javascript">
					$(function(){
						$('a[href*=#homeSlide]').on('click', function(e) {
							e.preventDefault();
							$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().left}, 1000);
							$('#scroll_home').show();
						});
					});
				</script>
				<a href="#homeSlide"><span></span></a>
			</div>  
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