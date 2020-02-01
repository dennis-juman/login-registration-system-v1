<?php
require_once 'message.php'; //INCLUDE error_page.php TO USE message() FUNCTION
require_once '../class/database_connection.php'; //INCLUDE database_connection.php TO USE THE METHOD connect() OF THE CLASS database_connection
require_once 'PHPMailer/PHPMailerAutoload.php';
include_once 'background_randomizer.php'; //INCLUDE BACKGROUND_RANDOMIZER.PHP TO LOAD THE FUNCTION
randomizer('../resource/wallpaper'); // ADD RANDOMIZED BACKGROUND USING THIS FUNCTION AND SPECIFY THE DIRECTORY WHERE THE BG IMAGES ARE

//CHECK IF POST VARIABLE OR VARIABLES ARE NOT SET | NOT SET = (FALSE)
if(!isset($_POST['submit'], $_POST['email'])){ 
    message("ERROR 1", "You do not have permission to view this page.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

//CHECK IF POST VARIABLE OR VARIABLES ARE EMPTY |  EMPTY = (TRUE)
if(empty($_POST['email'])){
    message("ERROR 2", "You did not fill out the required field.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//VALIDATE EMAIL
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    message("ERROR 3", "This email is not valid.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

$database_connection = new database_connection(); //INSTANTIATE NEW OBJECT
$connect = $database_connection -> connect(); //USE THE connect() METHOD TO CONNECT TO THE DATABASE

//CHECK IF THE THE EMAIL ADDRESS HAS ALREADY BEEN REGISTERED IN THE "user" DATABASE TABLE
$query = $connect->prepare("SELECT * FROM user WHERE email = ?");
$query->bindParam(1, $_POST['email'], PDO::PARAM_STR, 45);
$query->execute();
if(!empty($result = $query->fetch())){ //CHECK IF THE THE EMAIL ADDRESS HAS ALREADY BEEN REGISTERED IN THE DATABASE TABLE
    message("ERROR 4", "This email has already been registered.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

// INSERT EMAIL WITH ACTIVATION CODE INTO THE "verify_email" DATABASE TABLE
$query = $connect->prepare("SELECT * FROM verify_email WHERE email = ?");
$query->bindParam(1, $_POST['email'], PDO::PARAM_STR, 45);
$query->execute();
if(empty($result = $query->fetch())){ //CHECK IF EMAIL ADDRESS ALREADY EXISTS IN THE "verify_email" TABLE
    $query = $connect->prepare("INSERT INTO verify_email (email, activation_code) VALUES (?, ?)");
    $query->bindParam(1, $_POST['email'], PDO::PARAM_STR, 45);
    $activation_code = uniqid(); //ACTIVATION CODE STRING LENGTH = 13 CHARACTERS
    $query->bindParam(2, $activation_code, PDO::PARAM_STR, 13);
    $query->execute();
} else{
    $query = $connect->prepare("UPDATE verify_email SET email = :email, activation_code = :activation_code WHERE email = :email"); //UPDATE "activation_code" IF EMAIL ADRESS EXISTS IN THIS TABLE
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR, 45);
    $activation_code = uniqid(); //ACTIVATION CODE STRING LENGTH = 13 CHARACTERS
    $query->bindParam(':activation_code', $activation_code, PDO::PARAM_STR, 13);
    $query->execute();
}



//PHP MAILER
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers, EXAMPLE FOR MULTIPLE: smtp1.example.com;smtp2.example.com
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'verify@dummy@dummy.dummy';                 // SMTP username
$mail->Password = '*******your password******';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('verify@dummy@dummy.dummy', 'Admin name!');
$mail->addAddress($_POST['email'], 'Joe User');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = '[company name?] - Complete your registration!';
$link = "http://[your website name here]/website/library/php/complete_registration.php";
$mail->Body    = 'Here is your verification link:<br>' . $link . '?email=' . $_POST['email'] . '&activation_code=' . $activation_code;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    message("ERROR 5", "Message could not be sent.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
?>

<!DOCTYPE html>
<head>
    <title>Verify your email</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="library/css/login.css"> <!-- LINK CSS -->
    <link rel="stylesheet" type="text/css" href="library/css/background_randomizer.css"> 
    <?php  include('library/php/background_randomizer.php');
    randomizer("library/resource/wallpaper"); ?>
</head>
<body>
<?php

message(NULL, "If this email actually exists somewhere on this world, I will endeavor to send you a link not beyond 5 minutes in regards to complete your registration. If you can't find my message, check your spam folder.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
exit(); //STOP THE CODE
?>
<!-- PUT YOUR LOGO OR NAME AT THE BOTTOM RIGHT CORNER OF THE PAGE (BRANDING) -->
<div id="branding">Dennis Juman</div>
<!-- <img id="corner_logo" src="resources/icon/locker_white.ico" alt="locker icoon"> -->
</body>
</html>
