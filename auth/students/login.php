<?php
include '../../connect.php';
require '../../JWT/vendor/autoload.php'; 

$loginInput = filterRequest('login_input'); 
$password = $_POST['password'];
$language = filterRequest("language"); 

$statement = $connect->prepare("SELECT * FROM `students` WHERE email = ? OR contact_number = ?");
$statement->execute(array($loginInput, $loginInput));
$data = $statement->fetch(PDO::FETCH_ASSOC);
$count = $statement->rowCount();

if ($count > 0) {
    if (password_verify($password, $data['password'])) {
        $jwt = createJwt($data['student_id'], $key);

        $successMsg = ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Login successfully";
        echo json_encode(array(
            "status" => "success",
            "message" => $successMsg,
            "data" => array(
                "student_id" => $data['student_id'],
                "email" => $data['email'],
                "student_name" => $data['student_name'],
                "contact_number" => $data['contact_number'],
                "token" => $jwt,
            )
        ));
    } else {
        $errorMsg = ($language == "ar") ? "كلمة المرور غير صحيحة." : "Invalid password";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    }
} else {
    $errorMsg = ($language == "ar") ? "البريد الإلكتروني أو رقم الاتصال غير موجود." : "Email or contact number not found";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}
?>