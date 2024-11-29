// On successful login
$response = [
    'data' => [
        'type_of_access' => $userAccessType,  // the data will forward 'admin'
        'authToken' => $generatedAuthToken    // A JWT token or session ID
    ]
];

echo json_encode($response);

<?php
session_start();

// Assuming the user is authenticated and has admin access
if (!isset($_SESSION['authToken']) || $_SESSION['type_of_access'] !== 'admin') {
    // Go to login page if the user is not authenticated or not an admin
    header("Location:xammp/htdocs/Stem-AI/indexs/platform/login.html");
    exit;
}
?>