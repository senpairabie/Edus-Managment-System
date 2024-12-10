<?php
include '../connect.php';
include '../access_token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only GET requests are allowed."]);
    exit;
}

//getClasses($decoded->userId);
$teacher_id = $decoded->userId;
$language = filterRequestGet('language');
if ($language == "ar"){
        $query = "SELECT 
              class_title_ar,
              class_description_ar, 
              grade_id,
              semester_id,
              subject_id,
              class_date,
              start_time,
              end_time
         FROM 
          classes
        WHERE
          teacher_id = $teacher_id
        ";
//$class_id = filterRequest("class_id");

    $statement = $connect->query($query);
$class = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($class)) {
http_response_code(200); 
echo json_encode(["status" => "success", "data" => $class]);
} else {
http_response_code(204); 
echo json_encode(["status" => "fail", "message" => "No data found."]);
}}else{
    $query = "SELECT 
    class_title_ar,
    class_title_en,
    class_description_ar,
    class_description_en, 
    grade_id,
    semester_id,
    subject_id,
    class_date,
    start_time,
    end_time
FROM 
   classes
WHERE
teacher_id = $teacher_id
   ";
   //$class_id = filterRequest("class_id");

$statement = $connect->query($query);
$class = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($class)) {
http_response_code(200); 
echo json_encode(["status" => "success", "data" => $class]);
} else {
http_response_code(204); 
echo json_encode(["status" => "fail", "message" => "No data found."]);
}
}
?>