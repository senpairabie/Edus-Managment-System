<?php
include '../connect.php';
require '../JWT/vendor/autoload.php'; 
// $key = "secret_key_example";
$email = filterRequest('email');
$password = $_POST['password'];
$statement = $connect->prepare("SELECT * FROM `teacher_account` WHERE email = ?");
$statement->execute(array($email));
$data = $statement->fetch(PDO::FETCH_ASSOC);
$count = $statement->rowCount();

if ($data) {
    if(password_verify($password, $data['password'])){
    $jwt = createJwt($data['teacher_id'], $key);

    echo json_encode(array(
        "status" => "success",
        "message" => "Login successfully",
        "data" => $data,
        "access_token" => $jwt 
    ));
} else {
    echo json_encode(array("status" => "fail", "message" => "Login failed"));
}
} else {
    echo json_encode(array("status" => "fail", "message" => "Login failed"));
}
?>