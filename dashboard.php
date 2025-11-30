<?php
require 'includes/db.php';
session_start();

// Ensure user is logged in
if(empty($_SESSION['user_id'])){
    header('Location: login.php?redirect=dashboard.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle cancel order request
if(isset($_GET['cancel'])){
    $order_id = (int)$_GET['cancel'];
    // Only allow cancelling pending orders
    $stmt = $pdo->prepare("UPDATE orders SET status='Cancelled' WHERE id=? AND user_id=? AND status='Pending'");
    $stmt->execute([$order_id, $user_id]);
    header('Location: dashboard.php');
    exit;
}

// Fetch user's orders
$stmt = $pdo->prepare("
    SELECT o.id as order_id, o.quantity, o.order_date, o.status, m.name as item_name, m.category, m.price
    FROM orders o
    JOIN menu_items m ON o.item_id = m.id
    WHERE o.user_id=?
    ORDER BY o.order_date DESC
");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard – FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<p>Here is your order history:</p>

<?php if($orders): ?>
<table class="orders-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orders as $o): ?>
        <tr>
            <td><?php echo $o['order_id']; ?></td>
            <td><?php echo htmlspecialchars($o['item_name']); ?></td>
            <td><?php echo $o['category']; ?></td>
            <td><?php echo $o['quantity']; ?></td>
            <td>$<?php echo number_format($o['price']*$o['quantity'],2); ?></td>
            <td><?php echo $o['status']; ?></td>
            <td><?php echo $o['order_date']; ?></td>
            <td>
                <?php if($o['status']=='Pending'): ?>
                    <a href="dashboard.php?cancel=<?php echo $o['order_id']; ?>" class="btn cancel-btn">Cancel</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>You have no orders yet. <a href="menu.php">Place your first order!</a></p>
<?php endif; ?>

</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
