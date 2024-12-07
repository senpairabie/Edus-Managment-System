<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8');

$searchTerm = filterRequest("search");
$language = filterRequest("language");

try {
    $query = "SELECT * FROM `subjects` 
              WHERE `teacher_id` = :teacher_id 
                AND (`subject_title` LIKE :search 
                  OR `subject_description` LIKE :search)";

    $stmt = $connect->prepare($query);
    $searchLike = '%' . $searchTerm . '%';
    $stmt->bindParam(':teacher_id', $decoded->userId, PDO::PARAM_INT);
    $stmt->bindParam(':search', $searchLike, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        sendResponse(200, "success", $results);
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