<?php
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    if(!$_POST['name'] || !$_POST['email'] || !$_POST['email']) {
        die(header("location:../contact.php?loginFailed=true&reason=wrong"));
    }
    
    $valid_name = "/^[A-Za-z .'-]+$/";
    $valid_email = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($valid_email,$email) || !preg_match($valid_name,$name)) {
        die(header("location:../contact.php?loginFailed=true&reason=errorEmail"));
    }

    if(strlen($message) < 2) {
        die(header("location:../contact.php?loginFailed=true&reason=errorComments"));
    }
                                                   
    $from='From: '.$email."\r\n";
    $recipient="nag56@cornell.edu";
    $subject="Message from contact form";
    $msg = "Name: ".$name."\n";
    $msg .= "Email:".$email."\n";
    $msg .= "Message: ".$message."\n";

    mail($recipient, $subject, $msg, $from);
    header("location:../contact.php?loginSuccess=true&reason=success");
	 
?>
