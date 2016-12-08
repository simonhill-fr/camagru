<?php

function send_activation_email($email, $login, $activation)
{
    $to = $email;
    $subject = "Vailidate account to complete registration";
    $link = "http://localhost:8080/camagru/verify.php/?login=".$login."&key=".$activation."";
    $message = "
    Hello ".$login." , please click on the link below to activate your account : <br>\n
    <a href='".$link."' target='_blank'> Activate </a>
    ";
    $headers  = "From: camagru < noreply@camagru.com >\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
    $sent = mail($to, $subject, $message, $headers);
    return ($sent);
}

?>