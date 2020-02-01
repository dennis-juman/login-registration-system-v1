<!DOCTYPE html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet"> <!-- IMPORT FONTS -->
    <link rel="stylesheet" href="library/css/register.css"> <!-- LINK CSS -->
    <link rel="stylesheet" type="text/css" href="library/css/background_randomizer.css"> 
    <?php  include('library/php/background_randomizer.php');
    randomizer("library/resource/wallpaper"); ?>
</head>
<body>
    
<div id="login_form"> <!-- LOGIN FORM -->
    <h1 id="login_title">Register</h1> <!-- LOGIN TITLE -->
    <form method="POST" action="library/php/validate_registration.php">

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/identity.ico" alt="first name identity icon">
            <input type="text" name="first_name" placeholder="First name">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/identity.ico" alt="prefix name identity icon">
            <input type="text" name="prefix_name" placeholder="Prefix name">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/identity.ico" alt="last name identity icon">
            <input type="text" name="last_name" placeholder="Last name">
        </div>

        <div class="signup_field">
          <img class="register_icon" src="library/resource/icon/at_version_2.ico" alt="email icon">  
          <input type="email" name="email" placeholder="Email">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/identity.ico" alt="username identity icon">
            <input type="text" name="username" placeholder="Username">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/locker_white.ico" alt="password locker icon">
            <input type="password" name="password" placeholder="Password">
        </div>

        <div class="signup_field">
            <img class="register_icon" src="library/resource/icon/locker_white.ico" alt="password-repeat locker icon">
            <input type="password" name="password_confirm"" placeholder="Repeat password">
        </div>

        <div id="submit_button">
            <input type="submit" name="submit" value="Sign Up" id="submit">
        </div>
        </form>
    </form>
</div> <!-- END OF LOGIN FORM -->

<!-- PUT YOUR LOGO OR NAME AT THE BOTTOM RIGHT CORNER OF THE PAGE (BRANDING) -->
<div id="branding">Dennis Juman</div>
<!-- <img id="corner_logo" src="resources/icon/locker_white.ico" alt="locker icoon"> -->

</body>
</html>




