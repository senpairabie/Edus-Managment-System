<?php
include '../connect.php';
include '../access_token.php';
  $class_id = filterRequest('class_id');

    $query = "SELECT * From students WHERE class_id = $class_id";
    $statement = $connect->query($query);
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($students)) {
        echo json_encode(["status" => "success", "data" => $students]);
    } else {
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }


?>
