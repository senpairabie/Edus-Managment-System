<?php
include '../connect.php';
include '../access_token.php';
$class_title = filterRequest("class_title");
$Class_description = filterRequest("Class_description");
$grade_id = filterRequest("grade_id");
$semester_id = filterRequest("semester_id");
$subject_id = filterRequest("subject_id");
$group_id = filterRequest("group_id");
$language = filterRequest("language");


if (strlen($class_title) < 5) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 5 أحرف." : "Error: Class title must be more than 5 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($Class_description) < 20) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 20 حرفًا." : "Error: Class description must be more than 20 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($class_title) || empty($Class_description) || empty($grade_id) 
|| empty($semester_id) || empty($subject_id) || empty($group_id) ) {
    
    die("الرجاء ملء جميع الحقول");
} else {
    /* $token = generateRandomToken(100); */
    
    $data = array(
        "class_title" => $class_title,
        "Class_description" => $Class_description,
        "grade_id" => $grade_id,
        "semester_id" =>  $semester_id,
        "subject_id" => $subject_id,
        "group_id" => $group_id,    
    );
    insertData("classes", $data);

}


?>