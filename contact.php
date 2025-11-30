<?php
require 'includes/db.php';
session_start();

$errors = [];
$success = false;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if(!$name) $errors[] = 'Name is required.';
    if(!$email) $errors[] = 'Valid email is required.';
    if(!$message) $errors[] = 'Message cannot be empty.';

    if(empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO messages(name,email,subject,message) VALUES(?,?,?,?)");
        if($stmt->execute([$name,$email,$subject,$message])){
            $success = true;
        } else {
            $errors[] = 'Failed to send message, please try again.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us – FreshByte Bakery</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
<h1>Contact FreshByte Bakery</h1>

<?php if($success): ?>
    <p class="success">Thank you! Your message has been sent.</p>
<?php else: ?>
    <?php if($errors): ?>
        <ul class="errors">
        <?php foreach($errors as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">

        <label for="message">Message:</label>
        <textarea name="message" id="message" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>

        <button type="submit" class="btn">Send Message</button>
    </form>
<?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>

