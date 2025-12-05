<link rel="stylesheet" href="./responsive.css">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data
    $first = htmlspecialchars(trim($_POST['first_name']));
    $last = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $messageText = htmlspecialchars(trim($_POST['message']));

    $services = isset($_POST['services']) 
        ? implode(", ", $_POST['services']) 
        : "None";

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // Gmail credentials
        $mail->Username   = 'powerecugnd@gmail.com';  
        $mail->Password   = 'cztthsjjyhkkitsc';   // Gmail App Password only

        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // SENDER (must match your Gmail username)
        $mail->setFrom('powerecugnd@gmail.com', 'Power ECU Website');

        // RECEIVER (you)
        $mail->addAddress('powerecugnd@gmail.com');

        // REPLY TO USER
        $mail->addReplyTo($email, "$first $last");

        // EMAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message";

        $mail->Body = "
            <h2>New Contact Form Submission</h2>

            <p><strong>Name:</strong> $first $last</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>

            <p><strong>Services Selected:</strong><br>$services</p>

            <p><strong>Message:</strong><br>$messageText</p>
        ";

        $mail->send();

        echo "
        <script>
            alert('Message sent successfully!');
            window.location.href = 'contact.html';
        </script>
        ";

    } catch (Exception $e) {
        echo "
        <script>
            alert('Message failed to send: {$mail->ErrorInfo}');
            window.location.href = 'contact.html';
        </script>
        ";
    }
}
?>

