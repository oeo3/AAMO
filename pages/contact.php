<!DOCTYPE html>
<html lang="en-US">
	<head>
        <meta charset="UTF-8">
        <title>AAMO</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                <li><a href="https://www.facebook.com/AAMObyAayushaShrestha/" target="_blank" ><img src="../img/socialmediaicon/facebookblack.png" onmouseover="this.src='../img/socialmediaicon/facebookgold.png'" onmouseout="this.src='../img/socialmediaicon/facebookblack.png'"></a></li>
                <li><a href="https://www.instagram.com/aamo_nepal/?hl=en" target="_blank"><img src="../img/socialmediaicon/instablack.png" onmouseover="this.src='../img/socialmediaicon/instagold.png'" onmouseout="this.src='../img/socialmediaicon/instablack.png'"></a></li>
         		<li><a id="contactButton" href="contact.php">CONTACT US</a></li>
            </ul> 
            </div>
        </section>
    </body>
</html>