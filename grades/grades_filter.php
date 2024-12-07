<?php

include '../connect.php';
include '../access_token.php';

$order = isset($_POST['order']) ? strtoupper($_POST['order']) : 'DESC';

if ($order !== 'ASC' && $order !== 'DESC') {
    $order = 'ASC'; 
}

$query = "SELECT 
              g.grade_level AS GradeLevel, 
              g.grade_description AS Description,
              COUNT(s.student_id) AS StudentNo,
              g.status AS Status
          FROM 
              grades g 
               LEFT JOIN 
              students s
          ON 
              s.grade_id = g.grade_id
          GROUP BY 
              g.grade_id
          ORDER BY 
              g.grade_id $order"; 

$statement = $connect->query($query);
$grades = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($grades)) {
    echo json_encode(["status" => "success", "data" => $grades]);
} else {
    echo json_encode(["status" => "fail", "message" => "No data found."]);
}
?>