<?php
$key = "secret_key_example";
    require 'JWT/vendor/autoload.php'; 
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    

function authenticate($token, $key) {
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
?>