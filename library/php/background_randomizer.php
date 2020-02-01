<?php
function randomizer($directory){
    echo '<div id="background_image">';
    // $directory = "../resource/wallpaper"; //WALLPAPER DIRECTORY
    $wallpapers = array_slice(scandir($directory), 2); //SCAN DIRECTORY + PUT FILE NAMES INTO ARRAY
    shuffle($wallpapers); //SHUFFLE ARRAY
    $name = $directory . '/' . $wallpapers[0]; //LOAD ONE OF THE IMAGES

    echo '<img src="' . $name . '" alt="' . $name . '" id="load_background">';
    echo '</div>';
}
?>


<!-- INSTRUCTIONS ON HOW TO USE THIS FUNCTION.
THERE ARE FOUR STEPS IN TOTAL TO IMPLEMENT THIS ON A PAGE.

1. ADD THE CSS LINK FOR THIS DOCUMENT TO YOUR PAGE
2. INCLUDE THIS .PHP FILE
3. AFTER INCLUDING, USE THE FUNCTION RANDOMIZER() <--
4. SPECIFY THE DIRECTORY OF THE RESOURCE IMAGES INSIDE OF THE RANDOMIZER PARAMETERS AS A STRING VALUE. -->

