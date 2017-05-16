
                <!--Add Photos-->
                <form onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
                    <p>
                        File Name: <input type="text" name="title">
                        Image Credit Link: <input type="text" name="credit">
                        Album Title: <input type="text" name="album_title">
                        Album Id: <input type="text" name="id">
                        <br/><br/>
                        Image:
                        <!--File Upload-->
                        <input type="file" name="newphoto"/>
                        <br/><br/>
                        
                    </p>
                
                    <?php
                        $msg = "";
                        //if upload image is pressed
                        if(isset($_SESSION['logged_user_by_sql'])){
                            print "<p><input type='submit' name='upload' value='Upload Image'></p>";
                             }else{
                             print "<p>You must be logged in to use this feature.</p>";
                                print "<p>Go to our <a href='login.php'>login page</a></p>";
                        }
                        if (isset($_POST['upload'])){
                        if(!empty($_POST['title']) && !empty($_POST['credit']) && !empty($_FILES['newphoto'])){
                            
                            $newPhoto = $_FILES['newphoto'];
                            $originalName = $newPhoto['name'];
                             $text = $_POST['title'];
                            $credit = $_POST['credit'];
                            $albumtitle = $_POST['album_title'];
                            $albumid = $_POST['id'];
                            
                            $sql = "INSERT INTO `Images` (`Image_Title`,`Image_Path`,`Image_Credit`,`Album_Id`,`Album_Title`) VALUES ('$text', 'img/db_Images/$originalName', '$credit','$albumid','$albumtitle');";
                            mysqli_query($mysqli, $sql);
                            
                            if($newPhoto['error'] == 0){
                                $tempName = $newPhoto['tmp_name'];
                                move_uploaded_file($tempName,"img/db_Images/$originalName");
                                $_SESSION['photos'][] = $originalName;
                                print("The file $originalName was uploaded successfully.\n");
                                
                                require_once 'resize.php';
                                save_thumbnail("img/db_Images/$originalName","thumbnails/$originalName",200);
                            }else{
                                print("Error: The file $originalName was not uploaded.\n");
                                print "<p>You haven't logged in.</p>";
                                print "<p>Go to our <a href='login.php'>login page</a></p>";
                            }
                        }
                        }
                       
                    ?>
                </form>
    

                <!--End Add Photos-->
                
            </div>
        </div>
