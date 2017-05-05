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
        <section id="about">
            <div id="navbar_left">
                <a href="home.php"><img id="logo" src="../img/header/graphic.jpg" alt="logo"></a>
            </div>
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
                            echo "<form class='loginform' action='about.php' method='post'>";
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
                            echo "<form class='loginform' action='about.php' method='post'>";
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
                      </script></li>
                    <li><a href="fav.php">FAV</a></li>
                </ul>
            </div>
            
            <!--about content-->
            <div id="about-content">
                <div id="company">
                    <h1>COMPANY</h1>
                    <p>AAMO is a conceptual jewelry line inspired by all that is Kathmandu and beyond.</p>

                    <p>Each piece is purely handcrafted by local master craftsmen, who continue to practice the old ways of making jewelry, which has been passed down from generation to generation.</p>

                    <p>However, due of rapid commercialization, it has become increasing difficult for small scale artisans to sustain their livelihood. </p>

                    <p>One of the core missions of the brand is to highlight the immense ability of our artisans, while creating a sustainable line of jewelry that blends the contemporary with the traditional.</p>

                    <p>AAMO is working to create an environment that will allow traditional practices to be successfully passed down to the future generations to see, explore, practice and realize the endless possibilities within our nation.<br/><br/>

                    </p>
                    <a href="#founder"><span></span></a>
                    <script type="text/javascript">
                        $(function(){
                            $('a[href*=#founder]').on('click', function(e) {
                                e.preventDefault();
                                $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800, 'linear');
                            });
                        });
                    </script>
                </div>
                
                <div id="founder">
                    <h1>FOUNDER</h1>
                        <script type="text/javascript">
                            $(function(){
                                $('a[href*=#company]').on('click', function(e) {
                                    e.preventDefault();
                                    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().left}, 1000);
                                });
                            });
                        </script>
                        <a href="#company"><span></span></a>
                </div>
            </div>

            <!--footer-->
            <div id="footer">
                <ul>
                   <!--  <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank" ><img src="../img/socialmediaicon/facebookblack.png" onmouseover="this.src='../img/socialmediaicon/facebookgold.png'" onmouseout="this.src='../img/socialmediaicon/facebookblack.png'"></a></li>
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