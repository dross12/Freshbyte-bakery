<?php
require 'includes/db.php';
session_start();

// Check if user is logged in
if(empty($_SESSION['user_id'])){
    header('Location: login.php?redirect=order.php'); 
    exit;
}

$user_id = $_SESSION['user_id'];

// Get item details if ?item=ID is passed
$item_id = isset($_GET['item']) ? (int)$_GET['item'] : 0;
$item = null;

if($item_id){
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id=?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch();
}

// Process form submission
$errors = [];
$success = false;

if($_SERVER['REQUEST_METHOD']==='POST'){
    $item_id = (int)($_POST['item_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);

    if($item_id <= 0) $errors[] = 'Invalid item selected';
    if($quantity <= 0) $errors[] = 'Quantity must be at least 1';

    if(empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO orders(user_id, item_id, quantity) VALUES (?,?,?)");
        if($stmt->execute([$user_id, $item_id, $quantity])){
            $success = true;
        } else {
            $errors[] = 'Failed to place order, please try again.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Place Order – FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
<h1>Place Your Order</h1>

<?php if($success): ?>
    <p class="success">Thank you! Your order has been placed.</p>
<?
