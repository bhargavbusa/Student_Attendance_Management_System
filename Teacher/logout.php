<?php
session_start(); 
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['teacher_id']);
unset($_SESSION['teacher_name']);
unset($_SESSION['teacher_emailid']);
session_destroy(); // destroy session
header("location:login.php"); 
?>

