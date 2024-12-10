<?php
require_once 'mail.php';
$mail->From = 'treetech111@gmail.com';
$mail->FromName = 'MediaHub';
$mail->addAddress('mtti2002@gmail.com'); 
$mail->Subject = 'رساله من ميديا هاب';
$mail->Body    = 'ولا يا خول خد الرساله اهي <b>AIL</b>';
$mail->send();
if(!$mail->send()) {
    echo json_encode('Message could not be sent.') ;
    echo json_encode('Mailer Error: ')  . $mail->ErrorInfo;
} else {
    echo json_encode('Message has been sent') ;
}















?>