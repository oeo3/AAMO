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
            
            <!--about content-->
            <div id="about-content">
                <div id="company">
                    <h1>COMPANY</h1>
                    <p>“AAMO is a conceptual jewelry line inspired
by all that is Kathmandu and beyond. Each piece is purely handcrafted by local master craftsmen, who continue to practice the old ways of making jewelry, which has been passed down from generation to generation.

However, due of rapid commercialization, it
has become increasing difficult for small scale artisans to sustain their livelihood. One of the core missions of the brand is to highlight the immense ability of our artisans, while creating a sustainable line of jewelry that blends the contemporary with the traditional.

AAMO is working to create an environment
that will allow traditional practices to be successfully passed down to the future generations to see, explore, practice and realize the endless possibilities within our nation.”<br/><br/>

- AAYUSHA SHRESTHA
(Founder/Designer)
                    </p>
                    <script type="text/javascript">
                        $(function(){
                            $('a[href*=#founder]').on('click', function(e) {
                                e.preventDefault();
                                $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800, 'linear');
                            });
                        });
                    </script>
                    <a href="#founder"><span></span>ABOUT THE FOUNDER</a>
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
                    	<a href="#company"><span></span>ABOUT THE COMPANY</a>
                </div>
            </div>

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