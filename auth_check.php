<?php
session_start();

// Redirect to login if user is not authenticated
if(empty($_SESSION['user_id'])){
    // Optionally preserve redirect URL
    $redirect = $_SERVER['PHP_SELF'];
    header("Location: login.php?redirect=" . urlencode($redirect));
    exit;
}
?>
