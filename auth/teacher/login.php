<?php
include '../../connect.php';
require '../../JWT/vendor/autoload.php'; 

$email = filterRequest('email');
$password = $_POST['password'];
$language = filterRequest("language"); 

$statement = $connect->prepare("SELECT * FROM `teacher_account` WHERE email = ?");
$statement->execute(array($email));
$data = $statement->fetch(PDO::FETCH_ASSOC);
$count = $statement->rowCount();

if ($count > 0) {
    if (password_verify($password, $data['password'])) {
        $jwt = createJwt($data['teacher_id'], $key);

        $successMsg = ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Login successfully";
        echo json_encode(array(
            "status" => "success",
            "message" => $successMsg,
            "data" => array(
                "teacher_id" => $data['teacher_id'],
                "email" => $data['email'],
                "full_name" => $data['full_name'],
                "phone_number" => $data['phone_number'],
                "location" => $data['location'],
                "token" => $jwt,
            )
        ));
    } else {
        $errorMsg = ($language == "ar") ? "كلمة المرور غير صحيحة." : "Invalid password";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    }
} else {
    $errorMsg = ($language == "ar") ? "البريد الإلكتروني غير موجود." : "Email not found";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}
?>