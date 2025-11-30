<?php
session_start();
require 'includes/db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($user && $pass) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username=? OR email=?');
        $stmt->execute([$user,$user]);
        $u = $stmt->fetch();
        if ($u && password_verify($pass,$u['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $u['id'];
            $_SESSION['username'] = $u['username'];
            $_SESSION['role'] = $u['role'];
            header('Location: dashboard.php'); exit;
        } else $errors[] = 'Invalid credentials';
    } else $errors[] = 'Fill all fields';
}
