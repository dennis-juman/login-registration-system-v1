<!DOCTYPE html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="library/css/verify_email.css"> <!-- LINK CSS -->
    <link rel="stylesheet" type="text/css" href="library/css/background_randomizer.css"> 
    <?php  include('library/php/background_randomizer.php');
    randomizer("library/resource/wallpaper"); ?>
</head>
<body>

<div id="login_form"> <!-- LOGIN FORM -->
    <h1 id="login_title">Register</h1> <!-- LOGIN TITLE -->
    <form method="POST" action="library/php/verify_email.php">

        <div class="verify_email">
            <img class="login_button_icon" src="library/resource/icon/verify_email_icon.ico" alt="email icoon">
            <input type="email" name="email" id="email">
        </div>

        <div id="submit_button">
            <input type="submit" name="submit" value="Sign Up" id="submit">
        </div>

    </form>
</div> <!-- END OF LOGIN FORM -->

<!-- PUT YOUR LOGO OR NAME AT THE BOTTOM RIGHT CORNER OF THE PAGE (BRANDING) -->
<div id="branding">Dennis Juman</div>
<!-- <img id="corner_logo" src="resources/icon/locker_white.ico" alt="locker icoon"> -->

</body>
</html>



