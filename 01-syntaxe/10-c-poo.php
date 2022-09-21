<?php
namespace Cours\POO;

use Exception;

/**
 * la 3ème possibilité est de travailler dans le meme namespace
 *
 */
require "./10-a-poo.php";
class enfant extends Humain{}
$hum = new Humain();
/**
 * ! attention, en travaillant dans un namespace, les classes par defaut de PHP ne seront pas reconnues
 */
// $ex = new Exception();
/**
 * pour pouvoir les ré-utiliser, on peut simplement les faire précéder d'un 
 * "\" pour indiquer à PHP de chercher à la racine du namespace
 */
$ex = new \Exception();
/**
 * Dernier point sur la POO en PHP :
 * Certes, les namespaces sont des dossiers virtuels, mais par convention, on essaiera autant
 * que possible d'avoir nos classes dans des dossiers qui correponsdent à leur namespacce.
 * (Cela peut être utilie pour les retrouver ainsi que pour l'utilisation d'unautoloader
 *  une fonction qui fera les require à notre place.)
 * 
 * Résumé des conventions sur la POO :
    * une classe par Ficxhier.
    * le Fichier porte le meme nom que la classe.
    * Les 2 commencent par une ajuscule.
    * si un namespace est utilisé, les dossiers devront correspondre
 */
?>
<h3>use Exception;</h3>

/**
 * la 3ème possibilité est de travailler dans le meme namespace <br>
 *
 */
<strong>
   require "./10-a-poo.php"; <br>
   class enfant extends Humain{} <br>
   $hum = new Humain(); <br>
</strong>
/**
 <em>* ! attention, en travaillant dans un namespace, les classes par defaut de PHP ne seront pas reconnues</em>
 */
// <strong>$ex = new Exception();</strong> <br>
/**
 * pour pouvoir les ré-utiliser, on peut simplement les faire précéder d'un <br>
 * "\" pour indiquer à PHP de chercher à la racine du namespace <br>
 */
$ex = new \Exception(); <br>
/**
<br>Dernier point sur la POO en PHP :
<br>Certes, les namespaces sont des dossiers virtuels, mais par convention, on essaiera autant
<br>que possible d'avoir nos classes dans des dossiers qui correponsdent à leur namespacce.
<br>(Cela peut être utilie pour les retrouver ainsi que pour l'utilisation d'unautoloader
<br> une fonction qui fera les require à notre place.)
<br>
<br>Résumé des conventions sur la POO :
   <br>une classe par Ficxhier.
   <br>le Fichier porte le meme nom que la classe.
   <br>Les 2 commencent par une ajuscule.
   <br>si un namespace est utilisé, les dossiers devront correspondre
 */