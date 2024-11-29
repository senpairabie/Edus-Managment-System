<?php

define('MB', 1048576);

function filterRequest($requestName) {
    return htmlspecialchars(strip_tags($_POST[$requestName]));
}

function createJwt($userId, $key) {
    $payload = [
        'iss' => "http://yourdomain.com",
        'iat' => time(),
        'exp' => time() + 3600,
        'userId' => $userId
    ];

    return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
}

function login($connect, $username, $password, $key) {
    $statement = $connect->prepare("SELECT * FROM users WHERE userName = ? AND RejesterCode = ?");
    $statement->execute(array($username, $password));
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $count = $statement->rowCount();

    if ($count > 0) {
        return createJwt($data['id'], $key); // إرجاع التوكن
    }
    return null; // إذا فشل تسجيل الدخول
}

/* function authenticate($token, $key) {
  try {
      $decoded = JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
      return $decoded; 
  } catch (Exception $e) {
      return null;
  }
}

$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    echo json_encode(["status" => "fail", "message" => "Token not provided."]);
    exit();
}

$token = str_replace('Bearer ', '', $headers['Authorization']); 
$decoded = authenticate($token, $key); 

if ($decoded === null) {
    echo json_encode(["status" => "fail", "message" => "Invalid token."]);
    exit();
}
 */
function generateRandomToken($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%^&*()_+=-/?><,.>
  <{}[]}~'; $token='' ; $characterCount=strlen($characters); for ($i=0; $i < $length; $i++) { $token
    .=$characters[rand(0, $characterCount - 1)]; } return $token; } function insertData($table, $data, $json=true) {
    global $connect; foreach ($data as $field=> $v)
    $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $connect->prepare($sql);
    foreach ($data as $f => $v) {
    $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
    echo json_encode(array("status" => "success" , "message" => "Added successfully"));

    } else {
    echo json_encode(array("status" => "failed"));
    }
    }
    return $count;
    }

    function getTeacherinfo($userid){
    global $connect;
    $query = "SELECT `full_name`, `email`, `phone_number`, `location` FROM `teacher_account` WHERE teacher_id = $userid
    " ;
    $statement = $connect->query($query);
    $teacher = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($teacher)) {
    echo json_encode(array("status" => "success" , "data" => $teacher));
    } else {
    echo json_encode(["status" => "fail" , "message" => "Teacher not found."]);}
    }
    function getGrades() {
    global $connect;
    $query = "SELECT
    g.grade_level AS GradeLevel,
    g.grade_description AS Description,
    COUNT(s.student_id) AS StudentNo,
    /* COUNT(DISTINCT gr.group_id) AS GroupCount,
    */
    g.status AS Status
    FROM
    grades g
    LEFT JOIN
    students s
    ON
    s.grade_id = g.grade_id
    /* LEFT JOIN
    groups gr
    ON
    s.group_id = gr.group_id

    */

    GROUP BY
    g.grade_id";

    $statement = $connect->query($query);
    $grades = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($grades)) {
    echo json_encode(["status" => "success", "data" => $grades]);
    } else {
    echo json_encode(["status" => "fail", "message" => "No data found."]);
    }
    }