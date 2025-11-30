<?php
require 'includes/db.php';
session_start();

// Fetch featured menu items (cakes only for home)
$stmt = $pdo->query("SELECT * FROM menu_items WHERE category='Cake' ORDER BY id DESC LIMIT 4");
$featured = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
  <section class="hero">
    <h1>Welcome to FreshByte Bakery!</h1>
    <p>Delicious cakes, pastries, and breads baked fresh daily.</p>
    <a href="menu.php" class="btn">See Our Menu</a>
  </section>

  <section class="featured">
    <h2>Featured Cakes</h2>
    <div class="grid">
      <?php foreach($featured as $item): ?>
        <div class="card">
          <img src="assets/images/cakes/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
          <h3><?php echo htmlspecialchars($item['name']); ?></h3>
          <p><?php echo htmlspecialchars($item['description']); ?></p>
          <p class="price">$<?php echo number_format($item['price'],2); ?></p>
          <a href="order.php?item=<?php echo $item['id']; ?>" class="btn">Order Now</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="about-short">
    <h2>About FreshByte Bakery</h2>
    <p>At FreshByte, we bake with love every day. Our cakes, breads, and pastries are made from the finest ingredients, ensuring a sweet experience for everyone!</p>
    <a href="about.php" class="btn">Learn More</a>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
