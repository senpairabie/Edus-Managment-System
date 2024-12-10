<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8');

$searchTerm = filterRequestGet("search");
$language = filterRequestGet("language");

try {
    $query = "SELECT subject_id, teacher_id, 
                     subject_title_en, subject_title_ar, 
                     subject_description_en, subject_description_ar 
              FROM `subjects` 
              WHERE `teacher_id` = :teacher_id 
                AND (`subject_title_en` LIKE :search 
                  OR `subject_title_ar` LIKE :search 
                  OR `subject_description_en` LIKE :search 
                  OR `subject_description_ar` LIKE :search)";

    $stmt = $connect->prepare($query);
    $searchLike = '%' . $searchTerm . '%';
    $stmt->bindParam(':teacher_id', $decoded->userId, PDO::PARAM_INT);
    $stmt->bindParam(':search', $searchLike, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        $filteredResults = array_map(function($subject) use ($language) {
            if ($language === "ar") {
                unset($subject['subject_title_en'], $subject['subject_description_en']);
            } elseif ($language === "en") {
                unset($subject['subject_title_ar'], $subject['subject_description_ar']);
            }
            return $subject;
        }, $results);

        sendResponse(200, "success", $filteredResults);
    } else {
        sendResponse(404, "fail", $language == "ar" 
            ? "لم يتم العثور على أي مادة." 
            : "No subjects found.");
    }
} catch (PDOException $e) {
    logError($e->getMessage());
    sendResponse(500, "fail", $language == "ar" 
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}

function sendResponse($statusCode, $status, $data) {
    http_response_code($statusCode);
    echo json_encode(array("status" => $status, "data" => $data));
}

function logError($error) {
    error_log($error, 3, '../logs/error_log.log');
}
?>