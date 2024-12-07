<?php
include '../connect.php';
include '../access_token.php';


$homework_id = filterRequest("homework_id");
$assignment_title = filterRequest("assignment_title");
$class_id = filterRequest("class_id");
$due_date = filterRequest("due_date");
$language = filterRequest("language");

//getClasses2($homework_id);
if (!empty($homework_id)  && empty($assignment_title) && empty($class_id ) 
&& empty($due_date) ) {
    getHomework($homework_id); // استدعاء الدالة لجلب البيانات
    exit;
}
if (!empty($assignment_title) || !empty($class_id) || !empty($due_date) 
|| !empty($semester_id) || !empty($subject_id)) {
if (strlen($assignment_title) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم التكليف أكثر من 3 أحرف." 
    : "Error: Assaignment title must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($assignment_title) || empty($class_id) || empty($due_date) ){
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." 
    : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        //"homework_id" => $homework_id,
        "assignment_title" => $assignment_title,
        "class_id" => $class_id,
        "due_date" => $due_date
    );
    updateData("homework", $data, "homework_id = $homework_id");

}
}

?>