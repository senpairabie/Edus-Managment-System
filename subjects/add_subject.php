<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8'); 

$subject_title_en = filterRequest("subject_title_en");
$subject_title_ar = filterRequest("subject_title_ar");
$subject_description_en = filterRequest("subject_description_en");
$subject_description_ar = filterRequest("subject_description_ar");
$language = filterRequest("language");

if ($subject_title_en == "" || $subject_title_ar == "" || $subject_description_en == "" || $subject_description_ar == "" || $language == ""){
    sendResponse(400, "fail", $language == "ar" ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.");
    exit();
}

try {
    $query = "INSERT INTO subjects (subject_title_en, subject_title_ar, subject_description_en, subject_description_ar, teacher_id) VALUES (:subject_title_en, :subject_title_ar, :subject_description_en, :subject_description_ar, :teacher_id)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':subject_title_en', $subject_title_en);
    $stmt->bindParam(':subject_title_ar', $subject_title_ar);
    $stmt->bindParam(':subject_description_en', $subject_description_en);
    $stmt->bindParam(':subject_description_ar', $subject_description_ar);
    $stmt->bindParam(':teacher_id', $decoded->userId);
    if ($stmt->execute()) {
        $successMsg = ($language == "ar") 
            ? "تمت إضافة المادة بنجاح."
            : "Subject added successfully.";
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