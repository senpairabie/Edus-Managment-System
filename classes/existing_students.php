<?php
include '../connect.php';
include '../access_token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only GET requests are allowed."]);
    exit;
}

//getClasses($decoded->userId);
//$teacher_id = $decoded->userId;
//$language = filterRequestGet('language');
        $query = "SELECT 
              *
         FROM 
          students
                ";

    $statement = $connect->query($query);
$student = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($student)) {
http_response_code(200); 
echo json_encode(["status" => "success", "data" => $student]);
} else {
http_response_code(204); 
echo json_encode(["status" => "fail", "message" => "No data found."]);
} 

?>