<?php

function send_activation_email($email, $login, $activation)
{
    $folderPath = dirname($_SERVER["REQUEST_URI"]);
    $to = $email;
    $subject = "Validate account to complete registration";
    $link = $_SERVER['HTTP_HOST'] . $folderPath . "/verify.php/?login=".$login."&key=".$activation."";
    $message = "
    Hello ".$login." , please click on the link below to activate your account : <br>\n
    <a href='".$link."' target='_blank'> Activate </a>
    ";
    $headers  = "From: camagru <noreply@camagru.com>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
    $sent = mail($to, $subject, $message, $headers);
    return ($sent);
}

function send_comment_notif($email, $to_login, $comment_text)
{
    $to = $email;
    $subject = "New comment";
    $message = "
    Hello ".$to_login." , you have a new comment on your picture :<br>\n
    <i>".$comment_text."</i>
    ";
    $headers  = "From: camagru < noreply@camagru.com >\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
    $sent = mail($to, $subject, $message, $headers);
    return ($sent);
}


?>