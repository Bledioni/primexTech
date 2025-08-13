
<?php

require_once '../config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../display/css/contact.css">
</head>
<body>

<?php require_once './dashBoradNavInc.php'; ?>

<p>Home / <strong>Contact</strong></p>

<div class="contact-main-container">
    <!-- Contact Info -->
    <div class="contact-info">
        <h2>Get in Touch</h2>
        <p>If you have any questions, feel free to reach out to us. We’ll be happy to help you!</p>
        <ul>
            <li><strong>📍 Address:</strong> 123 Street Name, Prishtina, Kosovo</li>
            <li><strong>📞 Phone:</strong> +383 45 977 748</li>
            <li><strong>📧 Email:</strong> bledionmehmeti4@gmail.com</li>
        </ul>
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Send Us a Message</h2>
        <form action="#" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Your name..." required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your email..." required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</div>

</body>
</html>
