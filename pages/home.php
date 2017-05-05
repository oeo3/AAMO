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
                    <?php
                        if (isset($_SESSION['logged_user'])) {
                            $logged_user = $_SESSION['logged_user'];
                            echo "LOGOUT</a>";
                            echo "<div id='loginclick' class='modal'>";
                            echo "<div onclick='document.getElementById(\"loginclick\").style.display=\"none\"' class='close'>&times;</div>";
                            //<!-- Modal Content -->
                            echo "<form class='loginform' action='home.php' method='post'>";
                                echo "<label><b>Logged in as $logged_user</b></label>";
                                echo "<input type='submit' name='submitLogin' value='Logout'>";
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
                                echo "<label><b>Username</b></label>";
                                echo "<input type='text' placeholder='Enter Username' name='username' required>";
                                echo "<label><b>Password</b></label>";
                                echo "<input type='password' placeholder='Enter Password' name='psw' required>";
                                echo "<input type='submit' name='submitLogin' value='Login'>";
                                echo "<span class='forgotpsw'><a href='#'> Forgot password?</a></span>";
                            echo "</form>";                 
                            echo "</div>"; 
                        }
                    
                        require_once 'config.php';
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        if (isset($_POST['submitLogin'])) {
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
                    </script>

                    </li>

                    <li><a href="fav.php">FAV</li>
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