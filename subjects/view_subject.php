<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8'); 

$language = filterRequestGet("language");

if (!isset($decoded->userId)) {
    sendResponse(400, "fail", $language == "ar" 
        ? "خطأ: معرف المستخدم غير موجود." 
        : "Error: User ID is missing.");
    exit();
}

try {
    $query = "SELECT `subject_id`, `subject_title`, `subject_description` 
              FROM `subjects` 
              WHERE `teacher_id` = :teacher_id";

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':teacher_id', $decoded->userId);
    $stmt->execute();

    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($subjects) > 0) {
        sendResponse(200, "success", $language == "ar" 
            ? "تم جلب المواد بنجاح." 
            : "Subjects retrieved successfully.", $subjects);
    } else {
        sendResponse(404, "fail", $language == "ar" 
            ? "لا توجد مواد مسجلة لهذا المدرس." 
            : "No subjects found for this teacher.");
    }
} catch (PDOException $e) {
    logError($e->getMessage());
    sendResponse(500, "fail", $language == "ar" 
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}

function sendResponse($statusCode, $status, $message, $data = null) {
    http_response_code($statusCode);
    $response = array("status" => $status, "message" => $message);
    if ($data !== null) {
        $response["data"] = $data;
    }
    echo json_encode($response);
}

function logError($error) {
    error_log($error, 3, '../logs/error_log.log');
}
?>