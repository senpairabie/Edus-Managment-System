<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تغيير كلمة المرور - Edus Managment System</title>
  <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <style>
  body {
    font-family: "Poppins", sans-serif;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    color: white;
  }

  form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    max-width: 400px;
    width: 100%;
  }

  h1 {
    color: #9708C9;
    text-align: center;
  }

  input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #555;
    box-sizing: border-box;
    border-radius: 5px;
    background-color: #ffffff;
    color: #000;
  }

  input[type="submit"] {
    background-color: #9708C9;
    color: #ffffff;
    cursor: pointer;
    border: none;
  }

  input[type="submit"]:hover {
    background-color: #7a06a3;
  }

  .error {
    color: #e74c3c;
    text-align: center;
    margin-top: 10px;
  }

  @media (max-width: 600px) {
    form {
      max-width: 100%;
    }
  }
  </style>
</head>

<body>
  <form method="POST">
    <h1>Edus Managment System</h1>
    <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
    <input type="password" name="password" placeholder="كلمة المرور الجديدة" required>
    <input type="password" name="confirmPassword" placeholder="تأكيد كلمة المرور الجديدة" required>
    <input type="submit" value="تغيير كلمة المرور">
    <?php
include '../../connect.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $token = isset($_POST['token']) ? $_POST['token'] : null;
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($token !== null && $password == $confirmPassword) { 
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $statement = $connect->prepare("SELECT email FROM `password_reset_tokens` WHERE token = ? AND is_used = 0");
                $statement->execute(array($token));
                $count = $statement->rowCount();

                if ($count > 0) {
                    $data = $statement->fetch(PDO::FETCH_ASSOC);
                    $email = $data['email'];

                    $updatePasswordStatement = $connect->prepare("UPDATE `teacher_account` SET password = ? WHERE email = ?");
                    $updatePasswordStatement->execute(array($hashedPassword, $email));

                    $markTokenUsedStatement = $connect->prepare("UPDATE `password_reset_tokens` SET is_used = 1 WHERE token = ?");
                    $markTokenUsedStatement->execute(array($token));
                    $count = $markTokenUsedStatement->rowCount();

                    if ($count > 0) {
                        header("Location: success.php");
                        exit; 
                    } else {
                        echo "<div class='error'>حدث خطأ ما.</div>";
                    }

                } else {
                    echo "<div class='error'>رابط إعادة تعيين كلمة المرور غير صالح أو تم استخدامه بالفعل.</div>";
                }
            } else {
                echo "<div class='error'>كلمة المرور غير متطابقة أو الرابط غير صالح.</div>";
            }
        }
        ?>
  </form>
</body>

</html>