<?php
include '../connect.php';
include '../access_token.php';


$grade_id = filterRequest("grade_id");
$language = filterRequest("language");

function deleteData($table, $where, $json = true)
{
    global $connect;
    $stmt = $connect->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "Grade deleted successfully"));
        } else {
            echo json_encode(array("status" => "Failed to delete Grade"));
        }
    }
    return $count;
}
if (!empty($grade_id)){
deleteData("grades" , "grade_id = $grade_id");
}else{
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}
?>