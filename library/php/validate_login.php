<?php
require_once 'message.php'; //TO DISPLAY MESSAGES, THIS COULD BE AN ERROR MESSAGE, OR A FRIENDLY MESSAGE (USED FOR MULTI-PURPOSE)
include_once 'background_randomizer.php'; //INCLUDE BACKGROUND_RANDOMIZER.PHP TO LOAD THE FUNCTION
randomizer('../resource/wallpaper'); // ADD RANDOMIZED BACKGROUND USING THIS FUNCTION AND SPECIFY THE DIRECTORY WHERE THE BG IMAGES ARE


//CHECK IF THE THIS URL HAS BEEN COPY PASTED INTO A NEW TAB
if(!isset($_POST['email'], $_POST['password'])){
    message("ERROR_1", "You did not fill out the required information.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

$email = $_POST['email']; 
$password = $_POST['password'];

//CHECK IF ANY OF THE TEXT FIELDS CONTAIN EMPTY VALUES SUCH AS TRANSPARENT SPACES
if (empty($email) || empty($password)) {
    message("ERROR_2", "You did not fill out the required information.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

//CHECK email ON INVALID CHARACTERS
if (preg_match('/[A-Za-z0-9]+/', $email) == 0) {
    message("ERROR_3", "email contains invalid characters.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}


require_once '../class/database_connection.php'; //REQUIRE DATABASE database_connectION, IF NOT, SCRIPT WILL NOT CONTINUE TO THE NEXT PART
$database_conection = new database_connection(); // CREATE AN OBJECT OF THE DATABASE database_connectION CLASS
$database_connect = $database_conection->connect(); //MAKE THE OBJECT CALL A METHOD OUT OF THE CLASS TO MAKE A database_connectION

$query = $database_connect->prepare("SELECT password FROM user WHERE email = ?");
$query->bindParam(1, $email, PDO::PARAM_STR, 45);
$query->execute();

//THE VALUE OF THE VARIABLE ($RESULT) CAN EITHER BE; A email THAT IS NOT REGISTERED (EMPTY) IN THE DATABASE OR A PASSWORD THAT DOES NOT MATCH ITS email
$result = $query->fetchColumn(); 

//IF email AND PASSWORD ARE BOTH UNKNOWN / INCORRECT
if(!$result && !password_verify($password, $result)){
    message("ERROR 1", "This account does not exist.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

if(!$result){ //email NOT FOUND
    message("ERROR 2", "This email is not known.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
}

if(!password_verify($password, $result)){ //PASSWORD DOES NOT MATCH email
    message("ERROR 3", "This password is incorrect.", NULL); //REDIRECT USER AND GIVE ERROR MESSAGE
    exit(); //STOP THE CODE
} 

message("Successful Login", "Login successful, yay! Congratulations! :)", NULL);
