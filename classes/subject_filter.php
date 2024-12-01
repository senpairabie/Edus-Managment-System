<?php
include "../connect.php";
include "../access_token.php";

$subject_id = filterRequest('subject_id');
    $query = "SELECT 
                  c.class_title AS ClassTitle, 
                  c.grade_id AS Grade,
                  COUNT(DISTINCT s.student_id) AS StudentNo,
                  c.class_time AS Time

              FROM 
                  classes c 
                   LEFT JOIN 
                  students s
              ON 
                  s.grade_id = c.grade_id
                  /* LEFT JOIN 
                  groups gr
              ON 
                  s.group_id = gr.group_id
            
              */
              WHERE 
              c.subject_id = $subject_id
              GROUP BY 
                  c.class_id";

    $statement = $connect->query($query);
    $classes = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($classes)) {
        echo json_encode(["status" => "success", "data" => $classes]);
    } else {
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }

?>