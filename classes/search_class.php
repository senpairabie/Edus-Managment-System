<?php
include "../connect.php";
include "../access_token.php";
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only POST requests are allowed."]);
    exit;
}
$searchTerm = filterRequestGet("search");
$language = filterRequestGet("language");

if($language == "ar"){

 $query = "SELECT 
              c.class_title_ar AS ClassTitle, 
              c.grade_id AS Grade,
              COUNT(DISTINCT s.student_id) AS StudentNo,
              c.class_date AS DATE,
              c.class_time AS Class_Time
              
          FROM 
              classes c 
              LEFT JOIN 
              students s
          ON 
              s.grade_id = c.grade_id

          WHERE  c.teacher_id = :teacher_id
                AND (
                (c.class_title_ar LIKE :search OR c.class_title_en LIKE :search)OR
                ( c.Class_description_ar LIKE :search OR c.Class_description_en LIKE :search)
                )
          GROUP BY 
              c.class_id";}else {
    
    $query = "SELECT 
                 c.class_title_en AS ClassTitle, 
                 c.grade_id AS Grade,
                 COUNT(DISTINCT s.student_id) AS StudentNo,
                 c.class_date AS DATE,
                 c.class_time AS Class_Time
                 
             FROM 
                 classes c 
                 LEFT JOIN 
                 students s
             ON 
                 s.grade_id = c.grade_id
   
             WHERE  c.teacher_id = :teacher_id
                   AND (
                   (c.class_title_ar LIKE :search OR c.class_title_en LIKE :search)OR
                   ( c.Class_description_ar LIKE :search OR c.Class_description_en LIKE :search)
                   )
             GROUP BY 
                 c.class_id";
   }
try{
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
        ? "لم يتم العثور على أي فصل" 
        : "No classes found.");
}
} catch (PDOException $e) {
logError($e->getMessage());
sendResponse(500, "fail", $language == "ar" 
    ? "خطأ: حدث خطأ غير متوقع." 
    : "Error: An unexpected error occurred.");
}



function logError($error) {
error_log($error, 3, '../logs/error_log.log');
}


?>