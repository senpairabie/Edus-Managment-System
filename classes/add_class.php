<?php
include '../connect.php';
include '../access_token.php';
$class_title = filterRequest("class_title");
$Class_description = filterRequest("Class_description");
$grade_id = filterRequest("grade_id");
$semester_id = filterRequest("semester_id");
$subject_id = filterRequest("subject_id");
$language = filterRequest("language");
$class_time = filterRequest("class_time");


if (strlen($class_title) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف."
     : "Error: Class title must be more than 3 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} elseif (strlen($Class_description) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 10 حرفًا."
     : "Error: Class description must be more than 10 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} elseif (empty($class_title) || empty($Class_description) || empty($grade_id) 
|| empty($semester_id) || empty($subject_id) ) {
    
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة."
     : "Error: Please fill in all required fields.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        "teacher_id" => $decoded->userId,
        "class_title" => $class_title,
        "Class_description" => $Class_description,
        "grade_id" => $grade_id,
        "semester_id" =>  $semester_id,
        "subject_id" => $subject_id,
        "class_time" => $class_time,    
    );
    insertData("classes", $data , $language);

}


?>