<?php
include '../../connect.php';
include '../../access_token.php';

getStudentinfo($decoded->userId);




function getStudentinfo($userid){
  global $connect;
  $query = "SELECT `student_name`, `email`, `contact_number` FROM `students` WHERE student_id = $userid
  " ;
  $statement = $connect->query($query);
  $student = $statement->fetchAll(PDO::FETCH_ASSOC);

  if (!empty($student)) {
  echo json_encode(array("status" => "success" , "data" => $student));
  } else {
  echo json_encode(["status" => "fail" , "message" => "Student not found."]);}
  }
?>