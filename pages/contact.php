<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>AAMO</title>
        <link rel="stylesheet" type="text/css" href="../css/style2.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    </head>
    <body>
        <section id="products">
            <!--nav-->
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
                            echo "<form class='loginform' action='contact.php' method='post'>";
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
                            echo "<form class='loginform' action='contact.php' method='post'>";
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
                    <li>FAV</li>
                </ul>
            </div>

<div id="main_text">
                    <form  id= "contactform" name="contactform" action="includes/contactform.php" method="POST">
                        <div class="row">
                            <label id="submitterName"><b>Name   </b></label> <br />
                            <input id="name" class="input" name="name" type="text" value="" size="30" /><br />
                            <label id="submitterEmail"><b>Email   </b></label><br />
                            <input id="email" class="input" name="email" type="text" value="" size="30" /><br />
                        </div>
                        <div class="row">
                            <label id="submitterMessage"><b>Message    </b></label><br />
                            <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
                        </div>
                        <input id="submit_button" type="submit" value="Send email" />
                    </form>
                </div>

                <?php 
                    $reasons = array("wrong" => "You have left one or more fields blank.", "errorEmail" => "The name or email address you entered is not valid.", "errorComments" => "The message you entered is not valid."); 
                    if (isset($_GET["loginFailed"])) echo $reasons[$_GET["reason"]];
                    if (isset($_GET["loginSuccess"])){
                        echo "Thank you! Your email has been sent. I will get back to you shortly";
                    };
                        
                ?>
            
            <!--footer-->
            <div id="footer">
            <ul>
                <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank" ><img src="../img/socialmediaicon/facebookblack.png" alt="fbicon" onmouseover="this.src='../img/socialmediaicon/facebookgold.png'" onmouseout="this.src='../img/socialmediaicon/facebookblack.png'"></a></li>
                <li><a href="https://www.instagram.com/aamo_nepal/?hl=en" target="_blank"><img src="../img/socialmediaicon/instablack.png" alt="instaicon" onmouseover="this.src='../img/socialmediaicon/instagold.png'" onmouseout="this.src='../img/socialmediaicon/instablack.png'"></a></li>
                <li><a id="contactButton" href="contact.php">CONTACT US</a></li>
            </ul> 
            </div>
        </section>
    </body>
</html>