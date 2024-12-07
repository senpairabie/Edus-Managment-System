<?php
include '../../connect.php';
require '../../JWT/vendor/autoload.php'; 
$student_name = filterRequest("student_name");
$email = filterRequest("email");
$language = filterRequest("language");
try {
    $stmt = $connect->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $jwt = createJwt($user['student_id'], $key);
        echo json_encode(array(
            "status" => "success",
            "message" => ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Logged in successfully.",
            "data" => array(
                "student_id" => $user['student_id'],
                "email" => $user['email'],
                "student_name" => $user['student_name'],
                "contact_number" => $user['contact_number'],
                "token" => $jwt,
            )
        ));
    } else {
        $stmt = $connect->prepare("INSERT INTO students (student_name, email) VALUES (?, ?)");
        $stmt->execute(array($student_name, $email));
        $stmt = $connect->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $jwt = createJwt($user['student_id'], $key);
        echo json_encode(array(
            "status" => "success",
            "message" => ($language == "ar") ? "تم تسجيل الدخول بنجاح." : "Logged in successfully.",
            "data" => array(
                "student_id" => $user['student_id'],
                "email" => $user['email'],
                "student_name" => $user['student_name'],
                "contact_number" => $user['contact_number'],
                "token" => $jwt,
            )
        ));
    }
} catch (PDOException $e) {
    $errorMsg = ($language == "ar") ? "حدث خطأ أثناء تسجيل الدخول." : "Error occurred while logging in. Error details: " . $e->getMessage();
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
}