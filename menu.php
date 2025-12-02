<?php
require 'db.php';
session_start();

// Fetch all menu items
$stmt = $pdo->query("SELECT * FROM menu_items ORDER BY category, name");
$items = $stmt->fetchAll();

// Optional: Filter by category
$categoryFilter = $_GET['category'] ?? '';
if($categoryFilter){
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE category=? ORDER BY name");
    $stmt->execute([$categoryFilter]);
    $items = $stmt->fetchAll();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Menu – FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
  <h1>Our Menu</h1>

  <nav class="category-filter">
    <a href="menu.php" class="<?php echo $categoryFilter==''?'active':''; ?>">All</a>
    <a href="menu.php?category=Cake" class="<?php echo $categoryFilter=='Cake'?'active':''; ?>">Cakes</a>
    <a href="menu.php?category=Pastry" class="<?php echo $categoryFilter=='Pastry'?'active':''; ?>">Pastries</a>
    <a href="menu.php?category=Bread" class="<?php echo $categoryFilter=='Bread'?'active':''; ?>">Breads</a>
  </nav>

  <div class="grid">
    <?php if($items): ?>
      <?php foreach($items as $item): ?>
        <div class="card">
          <img src="assets/images/<?php echo strtolower($item['category']); ?>/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
          <h3><?php echo htmlspecialchars($item['name']); ?></h3>
          <p><?php echo htmlspecialchars($item['description']); ?></p>
          <p class="price">$<?php echo number_format($item['price'],2); ?></p>
          <a href="order.php?item=<?php echo $item['id']; ?>" class="btn">Order Now</a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No items found in this category.</p>
    <?php endif; ?>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
