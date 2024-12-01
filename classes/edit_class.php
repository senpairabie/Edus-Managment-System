<?php
include '../connect.php';
include '../access_token.php';


$class_id = filterRequest("class_id");
$class_title = filterRequest("class_title");
$Class_description = filterRequest("Class_description");
$grade_id = filterRequest("grade_id");
$semester_id = filterRequest("semester_id");
$subject_id = filterRequest("subject_id");
$language = filterRequest("language");

//getClasses2($class_id);
if (!empty($class_id)  && empty($class_title) && empty($Class_description ) 
&& empty($grade_id) && empty($semester_id) && empty($subject_id)) {
    getClasses2($class_id); // استدعاء الدالة لجلب البيانات
    exit;
}
if (!empty($class_title) || !empty($Class_description) || !empty($grade_id) 
|| !empty($semester_id) || !empty($subject_id)) {
if (strlen($class_title) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف." : "Error: Class title must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($Class_description) < 20) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الفصل أكثر من 20 حرفًا." : "Error: Class description must be more than 20 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($class_title) || empty($Class_description) || empty($grade_id) 
|| empty($semester_id) || empty($subject_id)){
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        //"class_id" => $class_id,
        "class_title" => $class_title,
        "Class_description" => $Class_description,
        "grade_id" => $grade_id,
        "semester_id" =>  $semester_id,
        "subject_id" => $subject_id,  
    );
    updateData("classes", $data, "class_id = $class_id");

}
}

?>