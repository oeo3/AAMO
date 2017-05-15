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
                            <form class="loginform" action="login.php">
                                <label><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="username" required>
                                <label><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw" required>
                                <button type="submit">Login</button>
                                <span class="forgotpsw"><a href="#"> Forgot password?</a></span>
                            </form>
                        </div> 
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
            <div id="productscontent">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#product_menu h1").click(function(){
                            //slide up all the link lists
                            $("#product_menu ul ul").slideUp();
                            //slide down the link list below h1 clicked - only if closed
                            if(!$(this).next().is(":visible")){
                               $(this).next().slideDown();
                            }
                        });
                        
                        $("#product_menu ul ul li a").click(function(){
                            //slide up all the link lists
                            $("#product_menu ul ul ul").slideUp();
                            //slide down the link list below h1 clicked - only if closed
                            if(!$(this).next().is(":visible")){
                               $(this).next().slideDown();
                            }
                        });
                    });
                </script>
            <div id="product_menu">
                <ul>
                    <li class="active">
                        <h1>Categories</h1>
                        <ul>
                            <li><a href="#">Jewelry</a></li>
                            <li><a href="#">Woodwork</a></li>
                            <li><a href="#">Textile</a></li>
                        </ul>
                    </li>
                    <li>
                        <h1>Filters</h1>
                        <ul>
                            <li><a href="#">Series</a>
                                <ul>
                                    <li><a href="#">Series 1</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Material</a>
                                <ul>
                                    <li><a href="#">Brass</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>    
            </div>
            
            <div class="gallery">
            <a href="#" class="item_image"><img src="../img/products/example1.jpg" alt="Together Necklace"/><!--Image Source: Aayusha Shrestha--><div class="cover"><p>Together Necklace</p><p>Material: Brass- 22kt double Gold plated</p></div></a>
            
            <a href="#" class="item_image"><img src="../img/products/example2.jpg" alt="Barsha Necklace"/><!--Image Source: Aayusha Shrestha--><div class="cover"><p>Barsha Necklace</p><p>Material: Brass- 22kt double Gold plated</p></div></a>
            

            <a href="#" class="item_image"><img src="../img/products/product3.jpg" alt="Barsha Necklace"/><!--Image Source: Aayusha Shrestha--><div class="cover"><p>Barsha Necklace</p><p>Material: Brass- 22kt double Gold plated</p></div></a>
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