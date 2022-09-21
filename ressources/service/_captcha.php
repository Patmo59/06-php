<?php 
if(session_status() === PHP_SESSION_NONE)
session_start();
// La liste des caractères acceptés dans le captcha.
$caracters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
/**
 * Génère une chaîne de caractère aléatoire
 *
 * @param string $caracters
 * @param integer $strenght
 * @return string
 */
function generateString(string $caracters, int $strength = 10): string{
    $randStr = "";
    // On boucle un nombre de fois équivalent à la valeur de $strength.
    for($i = 0; $i < $strength; $i++){
        // On choisi un caractère aléatoire qu'on concatène à $randStr
        $randStr .= $caracters[rand(0, strlen($caracters)-1)];
        // $randStr = $randStr . $caracters[rand(0, strlen($caracters)-1)];
    }
    return $randStr;
}
// Génère une nouvelle image avec (largeur, hauteur). qui est un objet de classe GdImage.
$image = imagecreatetruecolor(200, 50);
// Active les fonctions d'antialias pour améliorer la qualité de l'image.
imageantialias($image, true);
$colors = [];
// On choisi une plage de couleur aléatoire.
$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);
for ($i=0; $i < 5; $i++) { 
    /*
        prend un objet GdImage en premier argument.
        puis 3 valeurs numérique représentant les niveaux de couleur RGB.
        Retourne un INT qui représente un identifiant pour la couleur généré ainsi.
    */
    $colors[] = imagecolorallocate(
        $image,
        $red - 20*$i,
        $green - 20*$i,
        $blue - 20*$i
    );
}
/* 
    Rempli un objet GdImage donné en premier argument.
    à partir de la position (x,y) donné en second et troisième argument.
    avec la couleur donné en quatrième argument.
*/
imagefill($image, 0, 0, $colors[0]);
for ($i=0; $i < 10; $i++) { 
    // paramètre une largeur pour les lignes (en px);
    imagesetthickness($image, rand(2, 10));
    /* 
        Dessine rectangle dans l'image donné en premier argument.
        à la position de départ (x,y) donnée en second et troisième argument.
        à la position de fin (x,y) donnée en quatrième et cinquième argument.
        de la couleur donnée en sixième argument.
    */
    imagerectangle(
        $image,
        rand(-10, 190),
        rand(-10, 10),
        rand(-10, 190),
        rand(40, 60),
        $colors[rand(1,4)]
    );
}
// mon texte sera soit noir soit blanc.
$textColors = [
    imagecolorallocate($image, 0,0,0),
    imagecolorallocate($image, 255,255,255)
];
// un tableau contenant les différentes polices utilisable.
$fonts = [
    __DIR__ .'/../font/Acme-Regular.ttf',
    __DIR__ .'/../font/arial.ttf',
    __DIR__ .'/../font/typewriter.ttf',
];
// Je choisis une taille pour le string de mon captcha.
$strLength = 6;
// Je génère mon string aléatoire.
$captchaStr = generateString($caracters, $strLength);
// je sauvegarde mon string en session.
$_SESSION["captchaStr"] = $captchaStr;
// j'affiche les caractères de mon string 1 à 1.
for ($i=0; $i < $strLength; $i++) { 
    /* 
        On choisi un espacement pour nos lettres 
        ainsi qu'une position de départ initial. (en px)
    */
    $letterSpace = 170/$strLength;
    $initial = 15;
    /* 
        permet d'écrire dans l'image en premier argument,
        à la taille de la police donnée en second argument,
        penchées selon les degrés donnés en troisième argument,
        à la position (x,y) donné en quatrième et cinquième argument,
        de la couleur donnée en sixième argument,
        avec la police donnée en septième argument,
        le texte donné en huitième argument.
    */
    imagettftext(
        $image,
        24,
        rand(-15, 15),
        $initial + $i * $letterSpace,
        rand(25, 45),
        $textColors[rand(0,1)],
        $fonts[array_rand($fonts)],
        $captchaStr[$i]
    );
}
// Indique en entête de notre fichier, qu'il est de type image/png.
header("Content-type: image/png");
// Converti notre objet GdImage au format png.
imagepng($image);
?>