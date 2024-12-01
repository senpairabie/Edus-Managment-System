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

$student_name = filterRequest("student_name");
$parent_name = filterRequest("parent_name");
$grade_id = filterRequest("grade_id");
$class_id = filterRequest("class_id");
$gender = filterRequest("gender");
$contact_number = filterRequest("contact_number");
$date_of_birth = filterRequest("date_of_birth");
$address = filterRequest("address");
$language = filterRequest("language");

if (empty($student_name) || empty($parent_name) || empty($grade_id) || empty($class_id) || empty($gender) || empty($contact_number) || empty($date_of_birth) || empty($address)) {
    sendResponse(400, "fail", $language == "ar" ? "خطأ: الرجاء ملء جميع الحقول المطلوبة." : "Error: Please fill in all required fields.");
}

try {
    $query = "INSERT INTO `students` (`student_name`, `parent_name`, `grade_id`, `class_id`, `gender`, `contact_number`, `date_of_birth`, `address`) 
              VALUES (:student_name, :parent_name, :grade_id, :class_id, :gender, :contact_number, :date_of_birth, :address)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':parent_name', $parent_name);
    $stmt->bindParam(':grade_id', $grade_id);
    $stmt->bindParam(':class_id', $class_id);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':contact_number', $contact_number);
    $stmt->bindParam(':date_of_birth', $date_of_birth);
    $stmt->bindParam(':address', $address);

    if ($stmt->execute()) {
        $lastId = $connect->lastInsertId(); 
        $successMsg = ($language == "ar") 
            ? "تمت إضافة الطالب بنجاح بمعرف: $lastId."
            : "Student added successfully with ID: $lastId.";
        sendResponse(201, "success", $successMsg); 
    } else {
        sendResponse(500, "fail", $language == "ar" 
            ? "خطأ: حدثت مشكلة أثناء إضافة الطالب." 
            : "Error: There was a problem adding the student.");
    }
} catch (PDOException $e) {
    logError($e->getMessage()); 
    sendResponse(500, "fail", $language == "ar"
        ? "خطأ: حدث خطأ غير متوقع." 
        : "Error: An unexpected error occurred.");
}
?>