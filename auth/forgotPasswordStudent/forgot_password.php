<?php
include '../../connect.php';
if (!$connect) {
    echo json_encode(array("status" => "fail", "message" => "Error: Database connection failed."));
    exit;
}

$email = strtolower(filterRequest("email"));
$language = filterRequest("language");

$token = bin2hex(random_bytes(32));

$statement = $connect->prepare("INSERT INTO `password_reset_tokens` (email, token) VALUES (?, ?)");
$statement->execute(array($email, $token));

$mail->From = 'edus.app.eg@gmail.com';
$mail->FromName = 'Edus Managment System';
$mail->addAddress($email);
$mail->Subject = 'رسالة تأكيد إعادة تعيين كلمة المرور - Edus Managment System';

$mail->Body = '
    <html>
    <head>
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
      <style>
          .container {

            font-family: "Poppins", sans-serif;
              max-width: 600px;
              margin: 0 auto;
              padding: 20px;
              background-color: #ffffff; 
              border-radius: 10px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              text-align: center; 
          }
          h2 {
              color: #9708C9; 
          }
          p {
              font-size: 16px;
              color: #9708C9; 
          }
          .button {
              display: inline-block;
              padding: 10px 20px;
              background-color: #9708C9; 
              color: #ffffff;
              text-decoration: none;
              border-radius: 5px;
              margin-top: 20px;
          }
      </style>
  </head>
    <body>
        <div class="container">
            <h2>Edus Managment System</h2>
            <p>لإعادة تعيين كلمة المرور، يرجى النقر على الزر أدناه:</p>
            <a href="https://edus-ms.com/auth/forgotPasswordStudent/update_password.php?token=' . urlencode($token) . '" class="button">إعادة تعيين كلمة المرور</a>
        </div>
    </body>
    </html>
';
          
if ($mail->send()) {
    $successMsg = ($language == "ar") ? "تم إرسال رسالة إعادة تعيين كلمة المرور إلى بريدك الإلكتروني" : "Password reset message sent to your email";
    echo json_encode(array("status" => "success", "message" => $successMsg));
} else {
    echo json_encode(array("status" => "fail", "message" => "Error: Message could not be sent."));
}
?>