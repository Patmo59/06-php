<?php
/**
 * un des avantages de la POO c'est de ne plus avoir à se soucier
 * d'avoir deux fonctions ou 2 variables ayant le meme nom.
 * Puisqu'elles se trouvent dans des classes différentes, ce sont des méthodes
 * et propriétés différentes.
 * 
 * $maSuperClass -> travail() est different de $ma PetiteClass -> travail();
 * 
 * 
 * Mais sur un très gros projet avec énormément de bibliothèques différentes,
 *  il est possible d'avoir des classes ayant le meme nom.
 * ET on se retrouve alors avec le meme probleme que l'on avait avec les fonctions
 * "C'est la qu'entre en jeu les namespaces"
 */

use Cours\POO\Humain;

 #-------------------NAMESPACE ET USE---------------------#

 /**
  *  Les namespaces sont un peu comme des dossiers virtuels.
  * On ne crée pas vraiment de dosier, mais on range nos classes 
  *au bout d'un chemin défini dans le namespace. Le namespace
  * se déclare toujours tout en haut d'un fichier, avant tout autre code.
  *on utilise le motclé 'namespaces suivi du chemin
  */
 require "./10-a-poo.php";
 //class enfant extends Huamin{}
 //$hum = new Humain();
 /**
  * humain n'est pas trouvé alors qu'il est bien défini  cette classe dans
  * notre fichier précédent.
  * Cela à cause du mame space que l'on a placé en début de fichier
  *
  *ici il a tenté de chercher Humain à la racine du namespace ou il ne se trouve pas
  *pour accéder à une classe plusieurs solutions:
  *     -1. Ecrire le chemin complet du namespace :

  *

  */
  class enfant1 extends \Cours\POO\Humain{}
  $hum1 = new \Cours\POO\Humain();
  # -2. On peut aussi utiliser le mit 
  # 2.1. on peut aussi utiliser "as" pour créer un alias si on a deux classes du mme nom
  use Cours\POO\Humain as H;
  
  class enfant3 extends Humain{}
    $hum3 = new H();
    # 3.voir le fichier suivant
    ?>
    <hr>
     <br> un des avantages de la POO c'est de ne plus avoir à se soucier
     <br> d'avoir deux fonctions ou 2 variables ayant le meme nom.
     <br> Puisqu'elles se trouvent dans des classes différentes, ce sont des méthodes
     <br> et propriétés différentes.
     <br> 
     <br> $maSuperClass -> travail() est different de $ma PetiteClass -> travail();
     <br> 
     <br> 
     <br> Mais sur un très gros projet avec énormément de bibliothèques différentes,
     <br>  il est possible d'avoir des classes ayant le meme nom.
     <br> ET on se retrouve alors avec le meme probleme que l'on avait avec les fonctions
     <br> "C'est la qu'entre en jeu les namespaces"
     <br>
    
    -------------------<h3 >NAMESPACE ET USE</h3>---------------------
     <br>
    <strong>use Cours\POO\Humain;</strong>
    
    
     <hr>
      <br>  Les namespaces sont un peu comme des dossiers virtuels.
      <br> On ne crée pas vraiment de dosier, mais on range nos classes 
      <br>au bout d'un chemin défini dans le namespace. Le namespace
      <br> se déclare toujours tout en haut d'un fichier, avant tout autre code.
      <br>on utilise le motclé 'namespaces suivi du chemin
      <br>/
     <strong>require "./10-a-poo.php";</strong><br>
     //class enfant extends Huamin{} <br>
     //$hum = new Humain();<br>
     <hr>
      <br> humain n'est pas trouvé alors qu'il est bien défini par cette classe dans
      <br> notre fichier précédent.
      <br> Cela à cause du <strong>"namespace"</strong> que l'on a placé en début de fichier.
      <br>
      <br>ici il a tenté de chercher Humain à la racine du namespace ou il ne se trouve pas
      <br>pour accéder à une classe plusieurs solutions:
      <br>     -1. Ecrire le chemin complet du namespace :
    
      <br>
    
      <br>/
      <strong>class enfant1 extends \Cours\POO\Humain{}</strong><br>
      <strong>$hum1 = new \Cours\POO\Humain();</strong><br>
            -2. On peut aussi utiliser le mot <br>
            2.1. on peut aussi utiliser "as" pour créer un alias si on a deux classes du même nom : <br>
      <strong>use Cours\POO\Humain as H;</strong> <br>
      
      <strong>
        class enfant3 extends Humain{} <br>
          $hum3 = new H();
      </strong><br>
        # 3.voir le fichier suivant <br>