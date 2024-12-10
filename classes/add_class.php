<?php
include '../connect.php';
include '../access_token.php';
$class_title_ar = filterRequest("class_title_ar");
$class_title_en = filterRequest("class_title_en");
$Class_description_ar = filterRequest("Class_description_ar");
$Class_description_en = filterRequest("Class_description_en");
$grade_id = filterRequest("grade_id");
$semester_id = filterRequest("semester_id");
$subject_id = filterRequest("subject_id");
$language = filterRequest("language");
$class_date = filterRequest("class_date");
$start_time = filterRequest("start_time");
$end_time = filterRequest("end_time");


if (strlen($class_title_ar) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف."
     : "Error: Class title must be more than 3 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
}elseif(strlen($class_title_en) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف."
     : "Error: Class title must be more than 3 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} elseif (strlen($Class_description_ar) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 10 حرفًا."
     : "Error: Class description must be more than 10 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} elseif (strlen($Class_description_en) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 10 حرفًا."
     : "Error: Class description must be more than 10 characters.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} elseif (empty($class_title_ar) || empty($class_title_en)|| empty($Class_description_ar) || empty($Class_description_en) || empty($grade_id) 
|| empty($semester_id) || empty($subject_id) || empty($class_date) || empty($start_time) || empty($end_time) ) {
    
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة."
     : "Error: Please fill in all required fields.";
     http_response_code(400); 
    echo json_encode(array("status" => "failed", "message" => $errorMsg));
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        "teacher_id" => $decoded->userId,
        "class_title_ar" => $class_title_ar,
        "class_title_en" => $class_title_en,
        "Class_description_ar" => $Class_description_ar,
        "Class_description_en" => $Class_description_en,
        "grade_id" => $grade_id,
        "semester_id" =>  $semester_id,
        "subject_id" => $subject_id,
        "class_date" => $class_date,
        "start_time" => $start_time,    
        "end_time" => $end_time
    );
    insertData("classes", $data , $language);

}


?>