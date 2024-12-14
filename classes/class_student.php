<?php
include '../connect.php';
include '../access_token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only POST requests are allowed."]);
    exit;
}

  $class_id = filterRequestGet('class_id');

  $class_id = filterRequestGet('class_id') ?? null;

if ($class_id === null) {
    http_response_code(400); 
    echo json_encode(["status" => "fail", "message" => "Missing class_id."]);
    exit;
}

$query = "
    SELECT students.*
    FROM students
    WHERE students.student_id IN (
        SELECT student_id 
        FROM class_students 
        WHERE class_id = :class_id
    )
";
$statement = $connect->prepare($query);
$statement->execute([':class_id' => $class_id]);
$students = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($students)) {
    http_response_code(200); 
    echo json_encode(["status" => "success", "data" => $students]);
} else {
    http_response_code(404); 
    echo json_encode(["status" => "fail", "message" => "No data found."]);
}



?>
