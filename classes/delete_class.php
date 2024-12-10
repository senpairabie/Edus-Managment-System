<?php
include '../connect.php';
include '../access_token.php';


$class_id = filterRequest("class_id");
$language = filterRequest("language");

function deleteData($table, $where, $json = true)
{
    global $connect;
    $stmt = $connect->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            http_response_code(202); 
            echo json_encode(array("status" => "Class deleted successfully"));
        } else {
            http_response_code(400); 
            echo json_encode(array("status" => "Failed to delete class"));
        }
    }
    return $count;
}
if (!empty($class_id)){
deleteData("classes" , "class_id = $class_id AND teacher_id = $decoded->userId ");
}else{
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}
?>