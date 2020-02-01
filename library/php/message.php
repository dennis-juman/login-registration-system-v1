<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="../css/error.css">
<link rel="stylesheet" type="text/css" href="../css/background_randomizer.css"> 
</head>
<body>
<?php
//INSTRUCTIONS
// - NO PARAMETERS = AUTO REDIRECT TO HOME PAGE
// - SPECIFYING MESSAGE BUT NO TITLE OR HEADERLOCATION = SHOWS THE MESSAGE REGARDLESS
// - SPECIFYING NO SUBJECT = REDIRECT
function message($subject = '', $message = '', $headerLocation = "../../index.php"){
    if(empty($message)){
        header("Location: " . $headerLocation);
        exit();
    }
    echo "<title>". $subject . "</title>";
    echo "<h1>" . $message . "</h1>";
    exit();
}
?>
</body>
</html>