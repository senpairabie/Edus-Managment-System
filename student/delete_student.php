<?php
include '../connect.php';
include '../access_token.php';

function sendResponse($statusCode, $status, $message) {
    http_response_code($statusCode);
    echo json_encode([
        "status" => $status,
        "message" => $message,
    ]);
    exit();
}

header('Content-Type: application/json; charset=utf-8');

$student_id = filterRequest("student_id");
$language = filterRequest("language");

if (empty($student_id)) {
    sendResponse(400, "fail", $language == "ar" ? "خطأ: الرجاء تقديم معرف الطالب." : "Error: Please provide the student ID.");
}

try {
    $query = "DELETE FROM `students` WHERE `student_id` = :student_id";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':student_id', $student_id);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $successMsg = ($language == "ar") 
                ? "تم حذف الطالب بنجاح." 
                : "Student deleted successfully.";
            sendResponse(200, "success", $successMsg);
        } else {
            $errorMsg = ($language == "ar") 
                ? "خطأ: الطالب غير موجود." 
                : "Error: Student not found.";
            sendResponse(404, "fail", $errorMsg);
        }
    } else {
        sendResponse(500, "fail", $language == "ar" 
            ? "خطأ: حدثت مشكلة أثناء حذف الطالب." 
            : "Error: There was a problem deleting the student.");
    }
} catch (PDOException $e) {
    logError($e->getMessage());
    sendResponse(500, "fail", $language == "ar"
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}
?>