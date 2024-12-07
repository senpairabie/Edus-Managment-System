<?php
include '../../connect.php';
require '../../JWT/vendor/autoload.php'; 
$full_name = filterRequest("full_name");
$email = filterRequest("email");
$language = filterRequest("language");
try {
    $stmt = $connect->prepare("SELECT * FROM teacher_account WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $jwt = createJwt($user['teacher_id'], $key);
        echo json_encode(array(
            "status" => "success",
            "message" => ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Logged in successfully.",
            "data" => array(
                "teacher_id" => $user['teacher_id'],
                "email" => $user['email'],
                "full_name" => $user['full_name'],
                "phone_number" => $user['phone_number'],
                "location" => $user['location'],
                "token" => $jwt
            )
        ));
    } else {
        $stmt = $connect->prepare("INSERT INTO teacher_account (full_name, email) VALUES (?, ?)");
        $stmt->execute(array($full_name, $email));
        $stmt = $connect->prepare("SELECT * FROM teacher_account WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $jwt = createJwt($user['teacher_id'], $key);
        echo json_encode(array(
            "status" => "success",
            "message" => ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Logged in successfully.",
            "data" => array(
                "teacher_id" => $user['teacher_id'],
                "email" => $user['email'],
                "full_name" => $user['full_name'],
                "phone_number" => $user['phone_number'],
                "location" => $user['location'],
                "token" => $jwt
            )
        ));
    }
} catch (PDOException $e) {
    $errorMsg = ($language == "ar") ? "حدث خطأ أثناء تسجيل الدخول." : "Error occurred while logging in. Error details: " . $e->getMessage();
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}