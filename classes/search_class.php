<?php
include "../connect.php";
include "../access_token.php";

$searchTerm = filterRequest("search");
$language = filterRequest("language");


 $query = "SELECT 
              c.class_title AS ClassTitle, 
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

          WHERE  c.teacher_id = :teacher_id
                AND (c.class_title LIKE :search 
                  OR c.Class_description LIKE :search)
          GROUP BY 
              c.class_id";
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
/* $statement = $connect->prepare($query);
$statement->execute([
    ':grade_id' => $grade_id,
    ':teacher_id' => $decoded->userId
]);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($classes)) {
    echo json_encode(["status" => "success", "data" => $classes]);
} else {
    echo json_encode(["status" => "fail", "message" => "No data found."]);
} */

?>