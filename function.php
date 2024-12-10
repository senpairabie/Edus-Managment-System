<?php

define('MB', 1048576);

function filterRequest($requestName) {
    return htmlspecialchars(strip_tags($_POST[$requestName]));
}
function filterRequestGet($requestName) {
    return htmlspecialchars(strip_tags($_GET[$requestName]));
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
    .=$characters[rand(0, $characterCount - 1)]; } return $token; } 
    
    
    function sendResponse($statusCode, $status, $message) {
        http_response_code($statusCode); 
        echo json_encode(array("status" => $status, "message" => $message));
    }

function insertData($table, $data , $language)
    {
        $json = true;
        global $connect;
        foreach ($data as $field => $v)
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
                http_response_code(201); 
                echo json_encode(array("status" => "success" , "message" => $language == "ar"
                ? "تمت الاضافة بنجاح. " 
                : "Added Successfully."));
                
            } else {
                http_response_code(500); 
                echo json_encode(array("status" => "failed" , "message" => $language == "ar"
                ? "خطأ: حدث خطأ غير متوقع." 
                : "Error: An unexpected error occurred."));
            }
        }
        return $count;
}

function getTeacherinfo($userid){
        global $connect;
        $query = "SELECT `full_name`, `email`, `phone_number`, `location` FROM `teacher_account` WHERE  teacher_id = $userid " ;
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
/*                   COUNT(DISTINCT gr.group_id) AS GroupCount, 
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
function getClasses($teacher_id) {
    global $connect;
    $query = "SELECT 
                  c.class_title AS ClassTitle, 
                  c.grade_id AS Grade,
                  c.semester_id AS Semester,
                  COUNT(DISTINCT s.student_id) AS StudentNo,
                  c.class_date AS DATE,
                  c.start_time AS Start_Time,
                  c.start_time AS End_Time


              FROM 
                  classes c 
                   LEFT JOIN 
                  students s
              ON 
                  s.grade_id = c.grade_id
                  /* LEFT JOIN 
                  groups gr
              ON 
                  s.group_id = gr.group_id
            
              */
              WHERE 
              c.teacher_id = $teacher_id
              GROUP BY 
                  c.class_id";
                  

    $statement = $connect->query($query);
    $classes = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($classes)) {
        http_response_code(200); 
        echo json_encode(["status" => "success", "data" => $classes]);
    } else {
        http_response_code(204); 
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }
}
function getClasses2($class_id , $teacher_id) {
    global $connect;
    $query = "SELECT 
                   class_title,
                   class_description, 
                   grade_id,
                   semester_id,
                   subject_id,
                   class_date,
                   start_time,
                   end_time
              FROM 
                  classes
              WHERE
              class_id = $class_id  AND teacher_id = $teacher_id
                  ";
                  //$class_id = filterRequest("class_id");

    $statement = $connect->query($query);
    $class = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($class)) {
        http_response_code(200); 
        echo json_encode(["status" => "success", "data" => $class]);
    } else {
        http_response_code(204); 
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }
}
function updateData($table, $data, $where, $json = true)
{
    global $connect;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $connect->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(["status" => "success", "message" => "Class updated successfully."]);
        } else {
            echo json_encode(["status" => "fail", "message" => "Failed to update class."]);
        }
    }
    return $count;
}
function getGrades2($grade_id) {
    global $connect;
    $query = "SELECT 
                   grade_level,
                   grade_description
              FROM 
                  grades
              WHERE
              grade_id = $grade_id
                  ";
                  //$grade_id = filterRequest("grade_id");

    $statement = $connect->query($query);
    $class = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($class)) {
        echo json_encode(["status" => "success", "data" => $class]);
    } else {
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }
}

function getHomework($homework_id) {
    global $connect;
    $query = "SELECT 
                   assignment_title,
                   class_id, 
                   due_date

              FROM 
                  homework
              WHERE
              homework_id = $homework_id
                  ";
                  //$homework_id = filterRequest("homework_id");

    $statement = $connect->query($query);
    $homework = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($homework)) {
        echo json_encode(["status" => "success", "data" => $homework]);
    } else {
        echo json_encode(["status" => "fail", "message" => "No data found."]);
    }
}
/* function updateClass($table, $data, $where, $whereParams = [], $json = true)
{
    global $connect;

    $cols = [];
    $vals = [];

    foreach ($data as $key => $val) {
        $cols[] = "`$key` = ?";
        $vals[] = $val;
    }

    $vals = array_merge($vals, $whereParams);

    $sql = "UPDATE `$table` SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $connect->prepare($sql);
    $stmt->execute($vals);

    $count = $stmt->rowCount();

    if ($json) {
        if ($count > 0) {
            echo json_encode(["status" => "success", "message" => "Class updated successfully."]);
        } else {
            echo json_encode(["status" => "fail", "message" => "No changes made or class not found."]);
        }
    }

    return $count;
} */
