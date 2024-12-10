<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); 
    echo json_encode([
        "status" => "fail",
        "message" => "Method not allowed. Please use PUT."
    ]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$subject_id = $input['subject_id'] ?? null;
$subject_title_en = $input['subject_title_en'] ?? null;
$subject_title_ar = $input['subject_title_ar'] ?? null;
$subject_description_en = $input['subject_description_en'] ?? null;
$subject_description_ar = $input['subject_description_ar'] ?? null;
$language = $input['language'] ?? null;

if (empty($subject_id) || empty($subject_title_en) || empty($subject_title_ar) || empty($subject_description_en) || empty($subject_description_ar) || empty($language)) {
    sendResponse(400, "fail", $language == "ar" 
        ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." 
        : "Error: Please fill in all required fields.");
    exit();
}

try {
    $checkQuery = "SELECT * FROM `subjects` WHERE `subject_id` = :subject_id AND `teacher_id` = :teacher_id";
    $stmt = $connect->prepare($checkQuery);
    $stmt->execute(['subject_id' => $subject_id, 'teacher_id' => $decoded->userId]);
    $subject = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$subject) {
        sendResponse(404, "fail", $language == "ar" 
            ? "المادة غير موجودة لهذا المدرس." 
            : "Subject not found for this teacher.");
        exit();
    }

    $updateQuery = "UPDATE `subjects` 
                    SET `subject_title_en` = :subject_title_en, 
                        `subject_title_ar` = :subject_title_ar, 
                        `subject_description_en` = :subject_description_en, 
                        `subject_description_ar` = :subject_description_ar 
                    WHERE `subject_id` = :subject_id AND `teacher_id` = :teacher_id";
    $stmt = $connect->prepare($updateQuery);
    $result = $stmt->execute([
        'subject_title_en' => $subject_title_en,
        'subject_title_ar' => $subject_title_ar,
        'subject_description_en' => $subject_description_en,
        'subject_description_ar' => $subject_description_ar,
        'subject_id' => $subject_id,
        'teacher_id' => $decoded->userId
    ]);

    if ($result) {
        sendResponse(200, "success", $language == "ar" 
            ? "تم تحديث المادة بنجاح." 
            : "Subject updated successfully.");
    } else {
        sendResponse(500, "fail", $language == "ar" 
            ? "خطأ: حدثت مشكلة أثناء تحديث المادة." 
            : "Error: There was a problem updating the subject.");
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