<?php
include '../connect.php';
include '../access_token.php';

header('Content-Type: application/json; charset=utf-8'); 

$student_id = filterRequest("student_id");
$grade_id = filterRequest("grade_id");
$class_id = filterRequest("class_id");
$attendance_status = filterRequest("attendance_status");
$attendance_date = filterRequest("attendance_date");
$language = filterRequest("language") ?: "en";

if (empty($student_id) || empty($grade_id) || empty($class_id) || empty($attendance_status) || empty($attendance_date) || empty($language)) {
    sendResponse(400, "fail", $language == "ar" 
        ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." 
        : "Error: Please fill in all required fields.");
    exit();
}

$date = DateTime::createFromFormat('Y-m-d H:i:s', $attendance_date);
if (!$date || $date->format('Y-m-d H:i:s') !== $attendance_date) {
    sendResponse(400, "fail", $language == "ar" 
        ? "خطأ: تنسيق التاريخ غير صالح. يجب أن يكون بالتنسيق YYYY-MM-DD HH:MM:SS." 
        : "Error: Invalid date format. It should be YYYY-MM-DD HH:MM:SS.");
    exit();
}

try {
    $query = "INSERT INTO attendance (student_id, grade_id, class_id, attendance_status, attendance_date) 
              VALUES (:student_id, :grade_id, :class_id, :attendance_status, :attendance_date)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':grade_id', $grade_id);
    $stmt->bindParam(':class_id', $class_id);
    $stmt->bindParam(':attendance_status', $attendance_status);
    $stmt->bindParam(':attendance_date', $attendance_date);
    
    if ($stmt->execute()) {
        $successMsg = $language == "ar" 
            ? "تمت إضافة الحضور بنجاح."
            : "Attendance added successfully.";
        $lastInsertId = $connect->lastInsertId();
        sendResponse(201, "success", $successMsg, ["attendance_id" => $lastInsertId]);
    } else {
        sendResponse(500, "fail", $language == "ar" 
            ? "خطأ: حدثت مشكلة أثناء إضافة الحضور." 
            : "Error: There was a problem adding the attendance.");
    }
} catch (PDOException $e) {
    logError($e->getMessage()); 
    sendResponse(500, "fail", $language == "ar"
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}

function sendResponse($statusCode, $status, $message, $data = []) {
    http_response_code($statusCode); 
    echo json_encode(array_merge(["status" => $status, "message" => $message], $data));
}

function logError($error) {
    error_log($error, 3, '../logs/error_log.log'); 
}
?>


<!-- {
"student_id": "1",
"grade_id": "2",
"class_id": "3",
"attendance_status": "present",
"attendance_date": "2024-12-10 14:30:00",
"language": "en"
} -->