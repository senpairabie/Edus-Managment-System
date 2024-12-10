<?php
include "../connect.php";
include "../access_token.php";


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only GET requests are allowed."]);
    exit;
}
$grade_id = filterRequestGet('grade_id');
$language = filterRequestGet('language');
if ($language == "ar"){
 $query = "SELECT 
              c.class_title_ar AS ClassTitle,
              c.grade_id AS Grade,
              COUNT(DISTINCT s.student_id) AS StudentNo,
              c.class_date AS DATE,
              c.start_time AS Start_Time,
              c.start_time AS End_Time
          FROM 
              classes c 
              LEFT JOIN 
              students s
          ON 
              s.grade_id = c.grade_id
          WHERE 
              c.grade_id = :grade_id AND c.teacher_id = :teacher_id
          GROUP BY 
              c.class_id";

$statement = $connect->prepare($query);
$statement->execute([
    ':grade_id' => $grade_id,
    ':teacher_id' => $decoded->userId
]);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($classes)) {
    http_response_code(200); 
    echo json_encode(["status" => "success", "data" => $classes]);
} else {
    http_response_code(204); 
    echo json_encode(["status" => "fail", "message" => "No data found."]);
}
}else{
    $query = "SELECT 
    c.class_title_en AS ClassTitle,
    c.grade_id AS Grade,
    COUNT(DISTINCT s.student_id) AS StudentNo,
    c.class_date AS DATE,
    c.start_time AS Start_Time,
    c.start_time AS End_Time
FROM 
    classes c 
    LEFT JOIN 
    students s
ON 
    s.grade_id = c.grade_id
WHERE 
    c.grade_id = :grade_id AND c.teacher_id = :teacher_id
GROUP BY 
    c.class_id";

$statement = $connect->prepare($query);
$statement->execute([
':grade_id' => $grade_id,
':teacher_id' => $decoded->userId
]);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($classes)) {
http_response_code(200); 
echo json_encode(["status" => "success", "data" => $classes]);
} else {
http_response_code(204); 
echo json_encode(["status" => "fail", "message" => "No data found."]);
}
}


?>