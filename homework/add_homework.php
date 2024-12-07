<?php
include '../connect.php';
include '../access_token.php';

$assignment_title = filterRequest("assignment_title");
$class_id = filterRequest("class_id");
$due_date = filterRequest("due_date");
$language = filterRequest("language");

if (strlen($assignment_title) < 5) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الفصل أكثر من 3 أحرف." 
    : "Error: Assignment title must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($assignment_title) ||  empty($class_id) || empty($due_date) ) {
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        "assignment_title" => $assignment_title,
        "class_id" => $class_id,
        "due_date" => $due_date
    );
    insertData("homework", $data);

}


?>