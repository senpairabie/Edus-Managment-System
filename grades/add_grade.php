<?php
include '../connect.php';
include '../access_token.php';
$grade_level	 = filterRequest("grade_level");
$grade_description = filterRequest("grade_description");
$language = filterRequest("language");

if (strlen($grade_level	) < 3) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الصف أكثر من 3 أحرف." : "Error: grade title must be more than 3 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($grade_description) < 10) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون وصف الصف أكثر من 10 حرفًا." : "Error: grade description must be more than 10 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($grade_level	) || empty($grade_description)  ) {
    
    die("الرجاء ملء جميع الحقول");
} else {
    $data = array(
        "grade_level" => $grade_level	,
        "grade_description" => $grade_description,
        
    );
    insertData("grades", $data);

}
?>