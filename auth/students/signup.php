<?php
include '../../connect.php';
$student_name = filterRequest("student_name");
$email = filterRequest("email");
$contact_number = filterRequest("contact_number");
$password = $_POST['password'];
$language = filterRequest("language");

if (strlen($student_name) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الطالب أكثر من 3 أحرف." : "Error: Student name must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($password) < 8) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن تكون كلمة المرور أكثر من 8 حرفًا." : "Error: Password must be more than 8 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون البريد الإلكتروني صالحًا." : "Error: Email must be valid.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));    
} else {
    $token = generateRandomToken(100);

    $stat = $connect->prepare("SELECT email FROM `students` WHERE email = ?");
    $stat->execute(array($email));
    $cont = $stat->rowCount();
    
    if ($cont > 0) {
        $errorMsg = ($language == "ar") ? "البريد الإلكتروني أو رقم الهاتف موجود بالفعل." : "Email or phone number already exists.";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        try {
            $statement = $connect->prepare("INSERT INTO `students` (student_name, email, contact_number, password, token) VALUES (?, ?, ?, ?, ?)");
            $statement->execute(array($student_name, $email, $contact_number, $hashedPassword, $token));
            $count = $statement->rowCount();
            if ($count > 0) {
                $successMsg = ($language == "ar") ? "تم إنشاء حساب الطالب بنجاح." : "Student account created successfully.";
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