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
                            echo "<form class='loginform' action='products.php' method='post'>";
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
                            echo "<form class='loginform' action='products.php' method='post'>";
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
                    <li><a href="fav.php">FAV</li>
                </ul>
            </div>
            <div id="productscontent">
            <div id="product_menu">
                <h1>Categories</h1>
                <ul>
                    <li><a id="cat_jewel"> JEWELERY</a></li>
                    <li><a id="cat_wood">WOOD WORK</a></li>
                    <li><a id="cat_textiles">TEXTILES</a></li>
                </ul>
                <!--Note: category items: on click, sql code will search the database under the product in album table and show items which have the same value as the clicked filter-->
                <h2>Filters</h2>
                <ul class="filters">
                    <script type="text/javascript">
                        $(document).ready(function(){
                           $(".filters").click(function(){
                              $(".filters ul").slideDown(); 
                               //write code to slide content back up: if content is showing under ".filters ul", when ".filters ul" is clicked, sub content disappears. 
                                //if($(this).prev().is(".visible")){$(this).prev().slideUp();}
                           }); 
                        });
                    </script>
                    <li><a href="#" >Series<span class="sub_arrow"></span></a>
                        <ul class="filter_sub">
                           <li><a href="#">Garima</a></li>
                            <li><a href="#">Lo</a></li>
                            <li><a href="#">Shakti</a></li>
                        </ul>
                    </li>
                    <!--Note: sub menu items in the filter section: on click, sql code will search the database under the product table and show items which have the same value as the clicked filter-->
                    
                    <li><a href="#">Material</a></li>
                </ul>
            </div>
            
            <div class="gallery">
            <ul class="item_list">
                <li><a href="#" class="item_image"><img src="../img/products/example1.jpg" alt="Together Necklace"/><!--Image Source: Aayusha Shrestha--><div class="cover"><p>Together Necklace</p><p>Material: Brass- 22kt double Gold plated</p></div></a></li>
                <li><a href="#" class="item_image"><img src="../img/products/example2.jpg" alt="Barsha Necklace"/><!--Image Source: Aayusha Shrestha--><div class="cover"><p>Barsha Necklace</p><p>Material: Brass- 22kt double Gold plated</p></div></a></li>
            </ul>
            </div>

            </div>
            
            <!--footer-->
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