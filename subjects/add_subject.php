<?php
include '../connect.php';
include '../access_token.php';
$subject_title = filterRequest("subject_title");
$subject_description = filterRequest("subject_description");
$language = filterRequest("language");

if (strlen($subject_title) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الماده أكثر من 3 أحرف." : "Error: Subject title must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($subject_description) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الماده أكثر من 10 حرفًا." : "Error: Subject description must be more than 10 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($subject_title) || empty($subject_description)  ) {
    
    die("الرجاء ملء جميع الحقول");
} else {
    /* $token = generateRandomToken(100); */

    $data = array(
        "subject_title" => $subject_title,
        "subject_description" => $subject_description,
        
    );
    insertData("subjects", $data);

}
?>