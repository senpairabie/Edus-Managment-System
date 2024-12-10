<?php
include '../connect.php';
include '../access_token.php';


$class_id = filterRequestPut("class_id");
$class_title_ar = filterRequestPut("class_title_ar");
$class_title_en = filterRequestPut("class_title_en");
$Class_description_ar = filterRequestPut("Class_description_ar");
$Class_description_en = filterRequestPut("Class_description_en");
$grade_id = filterRequestPut("grade_id");
$semester_id = filterRequestPut("semester_id");
$subject_id = filterRequestPut("subject_id");
$language = filterRequestPut("language");
$class_date = filterRequestPut("class_date");
$start_time = filterRequestPut("start_time");
$end_time = filterRequestPut("end_time");

//getClasses2($class_id);
if (!empty($class_id)  && empty($class_title_ar) && empty($class_title_en) && empty($Class_description_ar) && empty($Class_description_en) 
&& empty($grade_id) && empty($semester_id) && empty($subject_id)  || empty($class_date) || empty($start_time) || empty($end_time)) {
    getClasses2($class_id , $decoded->userId); // استدعاء الدالة لجلب البيانات
    exit;
}
if (!empty($class_title_ar) || !empty($class_title_en)|| !empty($Class_description_ar) || !empty($Class_description_en) || !empty($grade_id) 
|| !empty($semester_id) || !empty($subject_id)) {
if (strlen($class_title_ar) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف." 
    : "Error: Class title must be more than 3 characters.";
    http_response_code(400); 
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}if (strlen($class_title_en) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف." 
    : "Error: Class title must be more than 3 characters.";
    http_response_code(400); 
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}  elseif (strlen($Class_description_ar) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 10 حرفًا." 
    : "Error: Class description must be more than 10 characters.";
    http_response_code(400); 
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($Class_description_en) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 10 حرفًا." 
    : "Error: Class description must be more than 10 characters.";
    http_response_code(400); 
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($class_title_ar) || empty($class_title_en)|| empty($Class_description_ar) || empty($Class_description_en) || empty($grade_id) 
|| empty($semester_id) || empty($subject_id) || empty($class_date) || empty($start_time) || empty($end_time)){
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." 
    : "Error: Please fill in all required fields.";
    http_response_code(400); 
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        //"class_id" => $class_id,
        "class_title_ar" => $class_title_ar,
        "class_title_en" => $class_title_en,
        "Class_description_ar" => $Class_description_ar,
        "Class_description_en" => $Class_description_en,
        "grade_id" => $grade_id,
        "semester_id" =>  $semester_id,
        "subject_id" => $subject_id,  
        "class_date" => $class_date,  
        "start_time" => $start_time,  
        "end_time" => $end_time,  

    );
    updateData("classes", $data, "class_id = $class_id");

}
}

?>