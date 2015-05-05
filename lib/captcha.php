<?php
// On démarre une session.
session_start();

header("Content-type: image/jpeg");

// La taille de la police.
$font_size = 20;

// On crée une image avec une certaine taille.
$image = imagecreate(130, 45);

// La couleur de l'image.
imagecolorallocate($image, 255, 255, 255);

// La couleur du texte.
$text_color = imagecolorallocate($image, 0, 0, 255);

// Pour les traits de masquage.
for($x=1; $x<=60; $x++)
{
    $x1 = rand(1,130);
    $y1 = rand(1,130);
    $x2 = rand(1,130);
    $y2 = rand(1,130);
    
    imageline($image, $x1, $y1, $x2, $y2, $text_color);
}

// La liste des caractères disponnible pour le captcha.
$liste = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "a", "B", "b", "C", "c", "D", "d", "E", "e", "F", "f", "G", "g", "H", "h", "I", "i", "J", "j", "K", "k", "L", "l", "M", "m", "N", "n", "O", "o", "P", "p", "Q", "q", "R", "r", "S", "s", "T", "t", "U", "u", "V", "v", "W", "w", "X", "x", "Y", "y", "Z", "z");
$code = "";

// On pioche 6 caractères dans la liste.
while(strlen($code) != 6)
{
    $code .= $liste[rand(0, 61)];
}

// On inscrit le code dans la session.
$_SESSION["capNum"] = $code;

// On met le code dans l'image.
imagettftext($image, $font_size, 8, 15, 40, $text_color, 'arial.ttf', $_SESSION["capNum"]);

// On reduit la qualité pour être plus difficile à lire par les robots et on l'affiche.
imagejpeg($image, NULL, 10);

// On detruit l'image.
imageDestroy($image);