<!DOCTYPE html>
<head>
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="library/css/home.css"> <!-- LINK CSS -->

    <link rel="stylesheet" type="text/css" href="library/css/background_randomizer.css"> 
    <?php  include('library/php/background_randomizer.php');
    randomizer("library/resource/wallpaper"); ?>
</head>
<body>

    <div id=button>
    <?php
        $time = date("H"); //24 HOUR CLOCK FORMAT
        $timezone = date("e"); // CURRENT TIME ZONE

        // BEFORE 12:00
        if ($time < "12") {     
            echo "<h1>Good morning.</h1>";
        } 

        // FROM 12 UNTIL 17:00
        if ($time >= "12" && $time < "17") {
            echo "<h1>Good afternoon.</h1>";
        } 

        // PAST 17:00
        if ($time >= "17") {
            echo "<h1>Good evening.</h1>";
        }
    ?>
        <button id="sign_up_button" type="button" onclick="location.href='verify_email.php'">
            <img src="library/resource/icon/image_1.jpg" alt="Sign Up">
            <h2>Sign Up</h2>
        </button>

        <button id="sign_in_button" onclick="location.href='login.php'" type="button">
            <img src="library/resource/icon/image_1.jpg" alt="Sign In">
            <h2>Sign In</h2>
        </button>
    </div>

</body>
</html>