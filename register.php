<?php
require 'includes/db.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (!$username) $errors[] = 'Username required';
    if (!$email) $errors[] = 'Valid email required';
    if (strlen($password) < 6) $errors[] = 'Password must be 6+ chars';
    if ($password !== $confirm) $errors[] = 'Passwords must match';

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username=? OR email=?');
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) $errors[] = 'Username or email taken';
        else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username,email,password_hash,display_name) VALUES (?,?,?,?)');
            $stmt->execute([$username,$email,$password_hash,$username]);
            header('Location: login.php?registered=1'); exit;
        }
    }
}
?>
<!-- Add HTML form below for registration -->
