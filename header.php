<?php session_start(); ?>
<nav>
  <a href="index.php">FreshByte Bakery</a>
  <ul>
    <li><a href="menu.php">Menu</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="order.php">Order</a></li>
    <li><a href="contact.php">Contact</a></li>
    <?php if(!empty($_SESSION['user_id'])): ?>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="register.php">Register</a></li>
    <?php endif; ?>
  </ul>
</nav>
