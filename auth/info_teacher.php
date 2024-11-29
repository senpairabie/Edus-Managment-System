<?php
include '../connect.php';
include '../access_token.php';

/* require '../JWT/vendor/autoload.php'; 
use \Firebase\JWT\JWT;

// $key = "secret_key_example";

function authenticate($token, $key) {
    try {
        $decoded = JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
        return $decoded; 
    } catch (Exception $e) {
        return null;
    }
}

$headers = getallheaders();
if (!isset($headers['Authorization'])) {
echo json_encode(["status" => "fail", "message" => "Token not provided."]);
 exit();
}

 $token = str_replace('Bearer ', '', $headers['Authorization']); 
 $decoded = authenticate($token, $key); 

if ($decoded === null) {
   echo json_encode(["status" => "fail", "message" => "Invalid token."]);
   exit();
} */
/* $query = "SELECT `full_name`, `email`, `phone_number`, `location` FROM `teacher_account` WHERE  teacher_id = " . $decoded->userId;
$statement = $connect->query($query);
$teacher = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($teacher)) {
    echo json_encode(array("status" => "success" , "data" => $teacher));
} else {
    echo json_encode(["status" => "fail" , "message" => "Teacher not found."]);
} */
getTeacherinfo($decoded->userId);
?>