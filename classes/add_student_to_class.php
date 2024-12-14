<?php
include '../connect.php';
include '../access_token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only POST requests are allowed."]);
    exit;
}
$student_id = filterRequest("student_id");
$class_id = filterRequest("class_id");
$language = filterRequest('language');

if (empty($student_id) || empty($class_id) || empty($language)) {
    
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} else {
    /* $token = generateRandomToken(100); */

    $stat = $connect->prepare("SELECT student_id FROM `class_students` WHERE student_id = ? AND class_id = ?");
    $stat->execute(array($student_id , $class_id));
    $cont = $stat->rowCount();
    
    if ($cont > 0) {
        $errorMsg = ($language == "ar") ? "هذا الطالب موجود بالفعل" : "This student already exists.";
        http_response_code(400);
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    } else {

    $data = array(
        "student_id" => $student_id,
        "class_id" => $class_id 
    );
    insertData("class_students", $data , $language);

}

}
?>