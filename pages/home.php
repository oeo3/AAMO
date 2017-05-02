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
                            });
                        });
                </script>
                <a href="#homecontent"><span></span>Scroll</a>
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
                if(i == images.length)
                    i = 0;
                    }, 5000);            
    	        });
            </script>
        <div id="navbar_left">
            <a href="home.php"><img id="logo" src="../img/header/graphic.jpg"></a>
        </div>
        <div id="navbar_right">
            <ul>
                <li><a id="aboutButton" href="about.php">ABOUT</a></li>
                <li><a id="productsButton" href="products.php">PRODUCTS</a></li>
                <li> <a onclick="document.getElementById('loginclick').style.display='block'">LOGIN</a>
                    <!-- The Modal -->
                    <div id="loginclick" class="modal">
                    <div onclick="document.getElementById('loginclick').style.display='none'" class="close">&times;</div>
                    <!-- Modal Content -->
                        <form class="loginform" action="login.php" method="post">
                            <label><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="username" required>
                            <label><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <input type="submit" name="submitLogin" value="Login">
                            <span class="forgotpsw"><a href="#"> Forgot password?</a></span>
                        </form>

                        <?php
                            require_once 'config.php';
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            if (isset($_POST['submitLogin'])) {
                                $username = htmlentities($_POST['username']);
                                $psw = htmlentities($_POST['psw']);

                                $result = $mysqli->query("SELECT * from Users WHERE username = '$username'");
                                $row = $result->fetch_assoc();
                                $correctp = $row['password'];

                                $valid_password = password_verify("$password", $correctp);        
                                echo "password_hash( 'mypassword', PASSWORD_DEFAULT)";

                                if ($valid_password && $username === $row['username']) {
                                    $_SESSION['logged_user'] = $username;
                                    header("Refresh:0");
                                    console.log("yay, logged in");
                                } 
                                else {
                                    console.log("log in failed");
                                }   
                            }
                        ?>

                    </div> 
                    <script>
		                var modal = document.getElementById('loginclick');
		                window.onclick = function(event) {
    	                   if (event.target == modal) {
        	                   modal.style.display = "none";
    	                   }
		                }
		            </script></li>
                <li>FAV</li>
            </ul>
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
                                });
                            });
                        </script>
                    	<a href="#homeSlide"><span></span>Scroll</a>
        </div>  
        </div>
        <div id="footer">
          	<ul>
                <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank" ><img src="../img/socialmediaicon/facebookblack.png" onmouseover="this.src='../img/socialmediaicon/facebookgold.png'" onmouseout="this.src='../img/socialmediaicon/facebookblack.png'"></a></li>
                <li><a href="https://www.instagram.com/aamo_nepal/?hl=en" target="_blank"><img src="../img/socialmediaicon/instablack.png" onmouseover="this.src='../img/socialmediaicon/instagold.png'" onmouseout="this.src='../img/socialmediaicon/instablack.png'"></a></li>
         		<li><a id="contactButton" href="contact.php">CONTACT US</a></li>
            </ul> 
        </div>
    </section>
</body>
</html>