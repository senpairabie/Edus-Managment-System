<?php
include '../connect.php';
include '../access_token.php';

$student_id = filterRequest("student_id");
$parent_name = filterRequest("parent_name");
$contact_number = filterRequest("contact_number");
$address = filterRequest ("address");
$relation = filterRequest('relation');
$language = filterRequest('language');

if (strlen($parent_name) < 5) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون اسم الوالد/الوالدة أكثر من 5 أحرف." : "Error: Parent name must be more than 5 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (strlen($contact_number) < 11) {
    $errorMsg = ($language == "ar") ? "خطأ: يجب أن يكون رقم الهاتف أكثر من 10 حرفًا." : "Error: Contact number must be more than 20 characters.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
} elseif (empty($student_id) || empty($parent_name) || empty($contact_number) || empty($address) || empty($relation) ) {
    
    die("الرجاء ملء جميع الحقول");
}else{
    $stat = $connect->prepare("SELECT * FROM `parent_infromation` WHERE student_id = ?  AND (parent_name = ? or contact_number = ? OR relation = ?) LIMIT 1");
    $stat->execute(array($student_id , $parent_name , $contact_number , $relation));
    $cont = $stat->rowCount();
    
    /* if ($cont > 0) {
        $errorMsg = ($language == "ar") ? "هذا الشخص موجود بالفعل" : "This parent is already exists.";
        echo json_encode(array("status" => "fail", "message" => $errorMsg));
    } */if ($cont > 0) {
    $existing = $stat->fetch(PDO::FETCH_ASSOC);
    if ($existing['relation'] == $relation) {
        $errorMsg = ($language == "ar") ? "خطأ: لا يمكن إضافة أكثر من شخص بنفس صلة القرابة." : "Error: Cannot add more than one person with the same relation.";
    } elseif ($existing['parent_name'] == $parent_name) {
        $errorMsg = ($language == "ar") ? "خطأ: هذا الاسم موجود بالفعل." : "Error: This name already exists.";
    } elseif ($existing['contact_number'] == $contact_number) {
        $errorMsg = ($language == "ar") ? "خطأ: رقم الهاتف هذا مستخدم بالفعل." : "Error: This contact number is already in use.";
    }
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
}else{
    

    /* $token = generateRandomToken(100); */

    $data = array(
        "student_id" => $student_id,
        "parent_name" => $parent_name,
        "contact_number" => $contact_number,
        "address" => $address,
        "relation" =>  $relation,
    );
    insertData("parent_infromation", $data);}

}


?>