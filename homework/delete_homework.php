<?php
include '../connect.php';
include '../access_token.php';


$homework_id = filterRequest("homework_id");
$language = filterRequest("language");


$json = true;
if (!empty($homework_id)){
    
    $stmt = $connect->prepare("DELETE FROM homework WHERE homework_id = $homework_id");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "Class deleted successfully"));
        } else {
            echo json_encode(array("status" => "Failed to delete class"));
        }
    }
    return $count;
//deleteData("homework" , "homework_id = $homework_id");
}else{
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}
?>