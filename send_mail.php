<?php
    $mailto = "deepakmundhra95@gmail.com";
    /*$mailSub = $_POST['mail_sub'];
    $mailMsg = $_POST['mail_msg'];*/
    $msg = "Request has been sent";
   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = "true";
   $mail ->SMTPSecure = "ssl";
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = "465"; // or 587
   $mail ->IsHTML();
   $mail ->Username = "deepakrocks.mundhra@gmail.com";
   $mail ->Password = "9333847141";
   $mail ->SetFrom("deepakrocks.mundhra@gmail.com");
   $mail ->Subject = "hi";
   $mail ->Body = $msg;
   $mail ->AddAddress($mailto);
   if(!$mail->Send())
   {
       echo "Mail Not Sent";
   }
   else
   {
       echo "Mail Sent";
   }