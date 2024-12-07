<?php

include '../connect.php';
include '../access_token.php';

$student_id = filterRequest('student_id');
    $query = "SELECT 
                   parent_name,
                   relation,
                   contact_number,
                   address
              FROM 
                  parent_infromation
              WHERE
              student_id = $student_id
                  ";
                  //$grade_id = filterRequest("grade_id");

    $statement = $connect->query($query);
    $parent = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($parent)) {
        echo json_encode(["status" => "success", "data" => $parent]);
    } else {
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }

?>