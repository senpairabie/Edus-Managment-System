<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8'); 

$subject_title = filterRequest("subject_title");
$subject_description = filterRequest("subject_description");
$language = filterRequest("language");

if (empty($subject_title) || empty($subject_description)) {
    sendResponse(400, "fail", $language == "ar" ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.");
    exit();
}

try {
    $query = "INSERT INTO `subjects` (`subject_title`, `subject_description`, `teacher_id`) VALUES (:title, :description, :teacher_id)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':title', $subject_title);
    $stmt->bindParam(':description', $subject_description);
    $stmt->bindParam(':teacher_id', $decoded->userId);
    if ($stmt->execute()) {
        $lastId = $connect->lastInsertId(); 
        $successMsg = ($language == "ar") 
            ? "تمت إضافة المادة بنجاح بمعرف: $lastId."
            : "Subject added successfully with ID: $lastId.";
        sendResponse(201, "success", $successMsg); 
    } else {
        sendResponse(500, "fail", $language == "ar" 
            ? "خطأ: حدثت مشكلة أثناء إضافة المادة." 
            : "Error: There was a problem adding the subject.");
    }
} catch (PDOException $e) {
    logError($e->getMessage()); 
    sendResponse(500, "fail", $language == "ar"
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}

function sendResponse($statusCode, $status, $message) {
    http_response_code($statusCode); 
    echo json_encode(array("status" => $status, "message" => $message));
}

function logError($error) {
    error_log($error, 3, '../logs/error_log.log'); 
}

?>