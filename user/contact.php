<?php
include '../include/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Job Portal</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>
        <div class="contact-form">
            <form action="#" method="post">
                <table class="contact-table">
                    <tr>
                        <td><label for="name">Your Name:</label></td>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Your Email:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="subject">Subject:</label></td>
                        <td><input type="text" id="subject" name="subject" required></td>
                    </tr>
                    <tr>
                        <td><label for="message">Message:</label></td>
                        <td><textarea id="message" name="message" rows="5" required></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Send Message</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

<?php include '../include/footer.php'; ?>
