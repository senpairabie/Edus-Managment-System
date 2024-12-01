<?php
include '../connect.php';
include '../access_token.php';


$grade_id = filterRequest("grade_id");
$grade_level = filterRequest("grade_level");
$grade_description = filterRequest("grade_description");
$language = filterRequest("language");

if (!empty($grade_id)  && empty($grade_level) && empty($grade_description ) ) {
    getGrades2($grade_id);
    exit;
}
if (!empty($grade_level) || !empty($grade_description)) {
if (strlen($grade_level) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الصف أكثر من 3 أحرف." : "Error: Grade level must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($grade_description) < 20) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الصف أكثر من 20 حرفًا." : "Error: Grade description must be more than 20 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($grade_level) || empty($grade_description)){
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
} else {

    $data = array(
        "grade_level" => $grade_level,
        "grade_description" => $grade_description
  
    );
    updateData("grades", $data, "grade_id = $grade_id");

}
}

?>