<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');  
define('DB_PASS', '');      
define('DB_NAME', 'user_auth');


session_start();


try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function redirectTo($page) {
    header("Location: " . $page);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>