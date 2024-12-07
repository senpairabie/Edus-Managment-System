<?php
include '../connect.php';
include '../access_token.php';

$student_name = filterRequest("student_name");
$phone_number = filterRequest("phone_number");
$password = $_POST['password'];
$date_of_birth = filterRequest ("date_of_birth");
$gender = filterRequest('gender');
$grade = filterRequest("grade");

if (strlen($student_name) < 5) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الطالب أكثر من 5 أحرف." : "Error: Student name must be more than 5 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($phone_number) < 11) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون رقم الهاتف أكثر من 10 حرفًا." : "Error: Phone number must be more than 20 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($student_name) || empty($phone_number) || empty($password) || empty($grade) || empty($gender) ) {
    
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} else {
    /* $token = generateRandomToken(100); */
    $token = generateRandomToken(100);

    $stat = $connect->prepare("SELECT email FROM `students` WHERE email = ?");
    $stat->execute(array($email));
    $cont = $stat->rowCount();
    
    if ($cont > 0) {
        $errorMsg = ($language == "ar") ? "البريد الإلكتروني أو رقم الهاتف موجود بالفعل." : "Email or phone number already exists.";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $data = array(
        "student_name" => $student_name,
        "phone_number" => $phone_number,
        "password" => $password,
        "date_of_birth" => $date_of_birth,
        "gender" =>  $gender,
        "grade_id" => $grade  
    );
    insertData("students", $data);

}

}
?>