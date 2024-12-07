<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    sendResponse(405, "fail", "Method not allowed. Use DELETE.");
    exit();
}

$inputData = json_decode(file_get_contents("php://input"), true);

$subject_id = isset($inputData['subject_id']) ? $inputData['subject_id'] : null;
$language = isset($inputData['language']) ? $inputData['language'] : "en";

if (empty($subject_id)) {
    sendResponse(400, "fail", $language == "ar" 
        ? "خطأ: الرجاء إدخال معرف المادة." 
        : "Error: Please provide the subject ID.");
    exit();
}

try {
    $query = "DELETE FROM `subjects` 
              WHERE `subject_id` = :subject_id 
                AND `teacher_id` = :teacher_id";

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(':teacher_id', $decoded->userId, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        sendResponse(200, "success", $language == "ar" 
            ? "تم حذف المادة بنجاح." 
            : "Subject deleted successfully.");
    } else {
        sendResponse(404, "fail", $language == "ar" 
            ? "خطأ: المادة غير موجودة أو أنك غير مخول بحذفها." 
            : "Error: Subject not found or you are not authorized to delete it.");
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