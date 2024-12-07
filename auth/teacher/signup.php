<?php
include '../../connect.php';
$full_name = filterRequest("full_name");
$email = filterRequest("email");
$phone = filterRequest("phone_number");
$location = filterRequest("location");
$password = $_POST['password'];
$language = filterRequest("language");

if (strlen($full_name) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم المستخدم أكثر من 3 أحرف." : "Error: Username must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($password) < 8) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن تكون كلمة المرور أكثر من 8 حرفًا." : "Error: Password must be more than 8 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون البريد الإلكتروني صالحًا." : "Error: Email must be valid.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));    
} else {
    $token = generateRandomToken(100);

    $stat = $connect->prepare("SELECT email FROM `teacher_account` WHERE email = ?");
    $stat->execute(array($email));
    $cont = $stat->rowCount();
    
    if ($cont > 0) {
        $errorMsg = ($language == "ar") ? "البريد الإلكتروني أو رقم الهاتف موجود بالفعل." : "Email or phone number already exists.";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        try {
            $statement = $connect->prepare("INSERT INTO `teacher_account` (full_name, email, phone_number, password, token, location) VALUES (?, ?, ?, ?, ?, ?)");
            $statement->execute(array($full_name, $email, $phone, $hashedPassword, $token, $location));
            $count = $statement->rowCount();
            if ($count > 0) {
                $successMsg = ($language == "ar") ? "تم إنشاء الحساب بنجاح." : "Account created successfully.";
                echo json_encode(array("status" => "success", "message" => $successMsg));   
            } else {
                $errorMsg = ($language == "ar") ? "خطأ: حدث خطأ أثناء إنشاء الحساب." : "Error: Something went wrong while creating account.";
                echo json_encode(array("status" => "fail", "message" => $errorMsg));
            }
        } catch (PDOException $e) {
            $errorMsg = ($language == "ar") ? "خطأ: حدث خطأ أثناء إنشاء الحساب." : "Error: Something went wrong while creating account.";
            echo json_encode(array("status" => "fail", "message" => $errorMsg));
        }
    }
}

?>