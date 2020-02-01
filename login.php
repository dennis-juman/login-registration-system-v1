<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="library/css/login.css"> <!-- LINK CSS -->
    <link rel="stylesheet" type="text/css" href="library/css/background_randomizer.css"> 
    <?php  include('library/php/background_randomizer.php');
    randomizer("library/resource/wallpaper"); ?>
</head>
<body>
<div id="login_form"> <!-- LOGIN FORM -->
    <h1 id="login_title">Login</h1> <!-- LOGIN TITLE -->
    <form method="POST" action="library/php/validate_login.php">

        <div class="signin_field">
            <img class="login_icon" src="library/resource/icon/user_white.ico" alt="email icoon">
            <input type="text" name="email" id="email">
        </div>
        <div class="signin_field">
            <img class="login_icon" src="library/resource/icon/locker_white.ico" alt="locker icoon">
            <input type="password" name="password" id="password">
        </div>

        <div id="submit_button">
            <input type="submit" name="submit" value="Sign In" id="submit">
        </div>

    </form>
</div> <!-- END OF LOGIN FORM -->

<!-- PUT YOUR LOGO OR NAME AT THE BOTTOM RIGHT CORNER OF THE PAGE (BRANDING) -->
<div id="branding">Dennis Juman</div>
<!-- <img id="corner_logo" src="resources/icon/locker_white.ico" alt="locker icoon"> -->
</body>
</html>
