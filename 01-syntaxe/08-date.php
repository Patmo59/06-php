<?php
$headerTitle = $title = " Dates ";
require("../ressources/template/_header.php");
// Si on a besoin du timestamp actuel :
echo time(), "<br>";
/* 
    Pour afficher une date en PHP, on utilisera la fonction date()
    Celles ci prend jusqu'à 2 arguments dont le premier est obligatoire.
    Le premier est un string sur lequel on reviendra juste après.
    Le second, optionnel, est un timestamp.
        Par défaut il utilisera le timestamp actuel, 
        mais si on a besoin d'une date futur ou passé, on peut lui donner un timestamp différent.
*/
echo date(""), "<br>";
/*
    Si je laisse vide mon string, rien ne s'affichera.
    Ce string doit contenir le format de la date (et/ ou l'heure)
    Pour cela on utilisera certaines lettres qui ont une signification pour la fonction date.

    Attention, les mois et jours seront en anglais.
*/
/* 
    d = numéro du jour du mois avec le 0.
    m = numéro du mois avec le 0.
    Y = année sur 4 chiffres.
*/
echo date("d/m/Y"), "<br>";
/*
    j = numéro du jour du mois sans le 0
    n = numéro du mois sans le 0
    y = année sur 2 chiffres.
*/
echo date("j/n/y"), "<br>";
/*
    D = nom du jour sur 3 lettres.
    l = nom du jour complet.
    M = nom du mois sur 3 lettres.
    F = nom du mois complet.
*/
echo date("D = l / M = F"), "<br>";
/*
    N = numéro du jour dans la semaine avec dimanche = 7;
    w = numéro du jour dans la semaine avec dimanche = 0;
*/
echo date("D = N = w"), "<br>";
/*
    z = numéro du jour dans l'année avec 1er Janvier = 0;
    W = numéro de la semaine dans l'année.
*/
echo date("z -> W"), "<br>";
/*
    t = nombre de jour dans le mois.
*/
echo date("F -> t"), "<br>";
/*
    L = boolean indiquant si l'année est bissextile.
*/
echo date("Y -> L"), "<br>";
/*
    h = l'heure en format 12 avec 0
    i = minutes avec 0
    s = secondes avec 0
    a = "am" ou "pm"
*/
echo date("h:i:s a"), "<br>";
/*
    g = heure au format 12 sans 0
    A = "AM" ou "PM"
*/
echo date("g:i:s A"), "<br>";
/*
    H = heure au format 24 avec 0
    v = millisecondes avec 0
        (v ne fonctionne pas avec tous les serveurs.)
*/
echo date("H:i:s:v"), "<br>";
/*
    G = heure au format 24 sans 0
*/
echo date("G:i:s"), "<br>";
/*
    O = différence d'heure avec GMT sans ":"
    P = différence d'heure avec GMT avec ":"
*/
echo date("O = P"), "<br>";
/*
    I = Boolean indiquant si c'est l'heure d'été.
    Z = différence d'heure avec GMT en seconde.
*/
echo date("I -> Z"), "<br>";
/*
    c = Date complète au format ISO 8601
*/
echo date("c"), "<br>";
/*
    r = Date complète au format RFC 2822
*/
echo date("r"), "<br>";
require("../ressources/template/_footer.php");
?>