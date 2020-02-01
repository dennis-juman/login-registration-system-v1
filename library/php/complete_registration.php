<?php
require '../class/database_connection.php'; //INCLUDE database_connection.php TO USE THE METHOD connect() OF THE CLASS database_connection
require_once 'message.php'; 
include_once 'background_randomizer.php'; //INCLUDE BACKGROUND_RANDOMIZER.PHP TO LOAD THE FUNCTION
randomizer('../resource/wallpaper'); // ADD RANDOMIZED BACKGROUND USING THIS FUNCTION AND SPECIFY THE DIRECTORY WHERE THE BG IMAGES ARE



//IF THE SUBMIT BUTTON HAS BEEN PRESSED, CHECK ALL THE VALUES FIRST AND THEN INSERT THEM INTO THE DB
if(isset($_POST['submit'])){
//CHECK IF ALL FIELDS HAVE BEEN SET WITH A VALUE
if(!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])){
    message("ERROR 1", "You do not fill out the required field(s).", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//PUT THE DATA INTO VARIABLES FOR LATER USE
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

//CHECK IF ANY OF THE FIELDS CONTAIN EMPTY VALUES SUCH AS TRANSPARENT SPACES ETC.
if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirm)) {
    message("ERROR 2", "You do not fill out the required field(s).", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

//CHECK IF PASSWORDS MATCH
if($password != $password_confirm){
    message("ERROR 3", "Passwords do not match.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//CREATE DATABASE CONNECTION
$database_connection = new database_connection(); //INSTANTIATE NEW OBJECT
$connect = $database_connection -> connect(); //USE THE connect() METHOD TO CONNECT TO THE DATABASE

//CHECK IF USER IS STILL IN THE "verify_email" TABLE
$query = $connect->prepare("SELECT * FROM verify_email WHERE email = ? AND activation_code = ?");
$query->bindParam(1, $_GET['email'], PDO::PARAM_STR, 45);
$query->bindParam(2, $_GET['activation_code'], PDO::PARAM_STR, 13);
$query->execute();
if(empty($result = $query->fetch())){ //CHECK IF THE THE EMAIL ADDRESS HAS ALREADY BEEN REGISTERED IN THE DATABASE TABLE
    message("ERROR 5", "This activation link has expired.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//AFTER ALL THESE CHECKS HAVE BEEN COMPLETED, INSERT USER INTO THE DATABASE TABLE
$query = $connect -> prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
$query->bindParam(1, $first_name, PDO::PARAM_STR, 45);
$query->bindParam(2, $last_name, PDO::PARAM_STR, 45);
$query->bindParam(3, $email, PDO::PARAM_STR, 45);
$password = password_hash($password, PASSWORD_DEFAULT); // HASH PASSWORD
$query->bindParam(4, $password, PDO::PARAM_STR, 90);
$query->execute();

//REMOVE THE USER FROM THE "verify_email" TABLE SO THAT THEY CANNOT REGISTER MULTIPLE TIMES USING THE ACTIVATION LINK FROM THEIR EMAIL AND UNSET ALL VALUES ASSOCIATES WITH GRANTING ACCESS TO THIS PAGE.
unset($_GET['email'], $_GET['activation_code'], $_POST['submit']);
$query = $connect -> prepare("DELETE FROM verify_email WHERE email = ?");
$query->bindParam(1, $email, PDO::PARAM_STR, 45);
$query->execute();
header( "refresh:5;url=../../login.php" ); //REDIRECT USER TO LOGIN PAGE

message(null, "Your account has been successfully created. You will be automatically redirected in 5 seconds to the sign in page.", null);
} else //ELSE DO THIS



//CHECK IF THE USER USED THE ACTIVATION LINK FROM HIS EMAIL
if(!isset($_GET['email'], $_GET['activation_code'])){
    message("ERROR 4", "You do not have permission to view this page.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//CHECK IF ACTIVATION LINK IS EXPIRED
$database_connection = new database_connection(); //INSTANTIATE NEW OBJECT
$connect = $database_connection -> connect(); //USE THE connect() METHOD TO CONNECT TO THE DATABASE
$query = $connect->prepare("SELECT * FROM verify_email WHERE email = ? AND activation_code = ?");
$query->bindParam(1, $_GET['email'], PDO::PARAM_STR, 45);
$query->bindParam(2, $_GET['activation_code'], PDO::PARAM_STR, 13);
$query->execute();
if(empty($result = $query->fetch())){ //CHECK IF THE THE EMAIL ADDRESS HAS ALREADY BEEN REGISTERED IN THE DATABASE TABLE
    message("ERROR 5", "This activation link has expired.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

//STORE THAT SPECIFIC USERS EMAIL AND ACTIVATION CODE IN VARIABLE
$email = $result['email']; 

//THE HTML FILE IS ONLY ACCESSABLE AFTER ALL THE CONDITIONS ABOVE MEET.

//THE HTML PAGE IS NOT ACCESSABLE WITHOUT AN ACTIVATION LINK
//THAT IS WHY WE CHECK IF THE SUBMIT BUTTON HAS BEEN PRESSED FIRST, BECAUSE WHEN WE SENT THE DATA THROUGH POST, THE GET VARIABLES IN THE URL (ACTIVATION CODE) DISSAPEARS WHICH MEANS THE DATA WILL NOT CONTINUE SENDING
//THIS IS THE REASON WE FIRST CHECK THE SUBMIT BUTTON, IF IT HAS BEEN PRESSED, IT MEANS THE USER HAD ACCESS TO THE SITE BECAUSE HE USED THE ACTIVATION LINK FROM HIS EMAIL
//I OBVIOUSLY DO NOT WRITE THIS IN THE HTML FILE BECAUSE OTHERWISE THE USER WOULD BE ABLE TO READ THIS IF HE DID ELEMENT INSPECT BUT I FOUND IT WORTHY TO NOTE THIS FOR FUTURE FLASHBACKS ON CODE BECAUSE IT'S KINDA HARD TO UNDERSTAND I GUESS
?>


<!DOCTYPE html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="../css/complete_registration.css"> <!-- LINK CSS -->
    <link rel="stylesheet" type="text/css" href="../css/background_randomizer.css"> 
    <?php  
    include_once('background_randomizer.php');
    randomizer("../resource/wallpaper"); 
    ?>
</head>
<body>
<div id="login_form"> <!-- LOGIN FORM -->
    <h1 id="login_title">Register</h1> <!-- LOGIN TITLE -->
    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <input type="hidden" name="email" value="<?php echo $email ?>">

        <div class="signup_field">
            <img class="register_icon" src="../resource/icon/identity.ico" alt="first name identity icon">
            <input type="text" name="first_name" placeholder="First name">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="../resource/icon/identity.ico" alt="last name identity icon">
            <input type="text" name="last_name" placeholder="Last name">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="../resource/icon/locker_white.ico" alt="password locker icon">
            <input type="password" name="password" placeholder="Password">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="../resource/icon/locker_white.ico" alt="password-repeat locker icon">
            <input type="password" name="password_confirm"" placeholder="Repeat password">
        </div>

        <div id="submit_button">
            <input type="submit" name="submit" value="Sign Up" id="submit">
        </div>

    </form>

</div> <!-- END OF LOGIN FORM -->

<!-- PUT YOUR LOGO OR NAME AT THE BOTTOM RIGHT CORNER OF THE PAGE (BRANDING) -->
<div id="branding">Dennis Juman</div>
<!-- <img id="corner_logo" src="resources/icon/locker_white.ico" alt="locker icoon"> -->

<!-- PLACE THE USERS EMAIL AND ACTIVATION CODE IN THE URL AGAIN
WHEN THE POST FORM HAS BEEN SUBMITTED, THE WEBSITE RELOADS, WHEN THE WEBSITE RELOADS THE USER DOESN'T HAVE ACCESS ANYMORE
BECAUSE THE $_GET VALUES DISSAPEAR, WE DO NOT WANT THAT BECAUSE WE STILL NEED TO USE THIS FILE AFTER IT HAS BEEN REFRESHED BY THE BROWSER-->


</body>
</html>