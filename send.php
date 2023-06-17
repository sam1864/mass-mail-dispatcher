<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $csv_file = $_FILES["csvfile"]["tmp_name"];
// Initialize arrays for valid and invalid emails
    $valid_emails = array();
    $invalid_emails = array();
    
    // Open the CSV file for reading
    $file_handle = fopen($csv_file, "r");
    
    // Loop through each line of the CSV file
    while (!feof($file_handle)) {
        $line = fgets($file_handle);
        $email = trim($line); // Remove whitespace and newlines
    
        // Validate the email address
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid_emails[] = $email;
        } else {
            $invalid_emails[] = $email;
        }
    }
    
    // Close the CSV file
    fclose($file_handle);

    for($i=0;$i<count($valid_emails);$i++)
{
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username=''; //enter your email
    $mail->Password = '';  //enter password
    $mail->SMTPSecure ='ssl';
    $mail->Port=465;

    $mail->setFrom('');  //enter your email
    $mail->addAddress($valid_emails[$i]);
    $mail->isHTML(true);
    $mail->Subject=$_POST["subject"];
    $mail->Body=$_POST["message"];

    $mail->send();
}
    echo "
<script>
alert('Email sent successfully');
   document.location.href = 'index.php'
</script>
";
}
?>