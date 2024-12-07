<?php
include '../connect.php';
include '../access_token.php';
  $class_id = filterRequest('class_id');

  $class_id = filterRequest('class_id') ?? null;

if ($class_id === null) {
    echo json_encode(["status" => "fail", "message" => "Missing class_id."]);
    exit;
}

$query = "SELECT * FROM students WHERE class_id = :class_id";

$statement = $connect->prepare($query);
$statement->execute([':class_id' => $class_id]);
$students = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($students)) {
    echo json_encode(["status" => "success", "data" => $students]);
} else {
    echo json_encode(["status" => "fail", "message" => "No data found."]);
}



?>
