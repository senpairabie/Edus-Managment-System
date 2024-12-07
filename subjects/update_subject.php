<?php
include '../connect.php';
include '../access_token.php';

function updateSubject($subject_id, $teacher_id, $subject_title, $subject_description) {
    global $connect;
    if (empty($subject_id) || empty($teacher_id) || empty($subject_title) || empty($subject_description)) {
        echo json_encode(["status" => "fail", "message" => "All fields are required."]);
        return;
    }
    $checkQuery = "SELECT * FROM `subjects` WHERE subject_id = ? AND teacher_id = ?";
    $stmt = $connect->prepare($checkQuery);
    $stmt->execute([$subject_id, $teacher_id]);
    $subject = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$subject) {
        echo json_encode(["status" => "fail", "message" => "Subject not found for this teacher."]);
        return;
    }

    $updateQuery = "UPDATE `subjects` SET subject_title = ?, subject_description = ? WHERE subject_id = ? AND teacher_id = ?";
    $stmt = $connect->prepare($updateQuery);
    $result = $stmt->execute([$subject_title, $subject_description, $subject_id, $teacher_id]);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Subject updated successfully."]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Failed to update subject."]);
    }
}

$subject_id = filterRequest("subject_id");
$teacher_id = filterRequest("teacher_id");
$subject_title = filterRequest("subject_title");
$subject_description = filterRequest("subject_description");

updateSubject($subject_id, $teacher_id, $subject_title, $subject_description);
?>