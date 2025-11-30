<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gallery – FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
<h1>FreshByte Bakery Gallery</h1>

<section class="gallery">
    <div class="grid">
        <div class="gallery-item">
            <img src="assets/images/gallery/cake1.jpg" alt="Chocolate Cake">
            <p>Chocolate Cake</p>
        </div>
        <div class="gallery-item">
            <img src="assets/images/gallery/pastry1.jpg" alt="Strawberry Pastry">
            <p>Strawberry Pastry</p>
        </div>
        <div class="gallery-item">
            <img src="assets/images/gallery/bread1.jpg" alt="Sourdough Bread">
            <p>Sourdough Bread</p>
        </div>
        <div class="gallery-item">
            <img src="assets/images/gallery/cake2.jpg" alt="Vanilla Cake">
            <p>Vanilla Cake</p>
        </div>
        <div class="gallery-item">
            <img src="assets/images/gallery/pastry2.jpg" alt="Chocolate Croissant">
            <p>Chocolate Croissant</p>
        </div>
        <div class="gallery-item">
            <img src="assets/images/gallery/bread2.jpg" alt="Baguette">
            <p>Baguette</p>
        </div>
        <!-- Add more items as needed -->
    </div>
</section>

</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
