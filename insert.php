<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php'; // Correct the path
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';




// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                    // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';               // Set the SMTP server
        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
        $mail->Username   = '21311@iiitu.ac.in';            // SMTP username
        $mail->Password   = 'qoem xbpv gnlw nyzb';          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                            // TCP port to connect to

        // Retrieve form data
        $senderEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senderName = htmlspecialchars($_POST['name']);
        $mobile = htmlspecialchars($_POST['mobile']);
        $query = htmlspecialchars($_POST['query']);

        // Validate email input
        if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        // Recipients
        $mail->setFrom($senderEmail, $senderName); // Sender's email and name
        $mail->addAddress('abhileshjha12@gmail.com', 'Oasis Venetia Heights'); // Recipient's email
        
                    

        // Email content
        $mail->isHTML(true);                                      // Set email format to HTML
        $mail->Subject = 'Oasis Venetia Heights Query';
        $mail->Body = "<p>
<b>Name :</b> {$senderName}<br>
<b>Email :</b> {$senderEmail}<br>
<b>Contact :</b> {$mobile}<br></p>";

        // Send the email
        if ($mail->send()) {
            echo '<script>window.location="thanks.php"</script>';
        } 

    } catch (Exception $e) {
        echo '<script>window.location="index.html"</script>';
    }
}
?>

