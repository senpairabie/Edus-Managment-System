
<?php
include '../connect.php';
include '../access_token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo json_encode(["status" => "fail", "message" => "Invalid request method. Only POST requests are allowed."]);
    exit;
}


$student_ids = $_POST['student_ids'] ?? null; 
$class_id = $_POST['class_id'] ?? null;
$language = $_POST['language'] ?? null;

if (empty($student_ids) || empty($class_id) || empty($language)) {
    $errorMsg = ($language == "ar") ? "خطأ: الرجاء ملء جميع الحقول المطلوبة."
     : "Error: Please fill in all required fields.";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
}

$student_ids = json_decode($student_ids, true);

if (!is_array($student_ids)) {
    $errorMsg = ($language == "ar") ? "  خطأ: معرفات الطلاب يجب أن تكون في صيغة قائمة مثل [1,2]" 
    : "Error: Student IDs should be a valid JSON array like [1,2].";
    echo json_encode(array("status" => "fail", "message" => $errorMsg));
    exit;
}

foreach ($student_ids as $student_id) {
    $stat = $connect->prepare("SELECT student_id FROM `class_students` WHERE student_id = ? AND class_id = ?");
    $stat->execute(array($student_id, $class_id));
    $cont = $stat->rowCount();

    if ($cont > 0) {
        http_response_code (200);
        $errorMsg = ($language == "ar") ? "هذا الطالب موجود بالفعل" :
         "This student already exists.";
         echo json_encode(array("status" => "fail", "message" => $errorMsg));

    } else {
        $data = array(
            "student_id" => $student_id,
            "class_id" => $class_id
        );
        insertData("class_students", $data, $language);

    }
}

?>

