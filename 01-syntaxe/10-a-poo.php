<?php
//" ignorez cela , on en parle dans le prochain fichier"
namespace  Cours\POO;

?>
<h1><strong>namespace  Cours\POO</strong></h1>
<?php
/**
 * jusqu'ici on a fait de la programmation procédurale.
 *  -le code est lu de haut en bas et c'est tout.
 * 
 * La programmation fonctionnelle.
 *  - Le code est lu de haut en bas, mlais de temps en temps fait
 * appel à des fonctions déclarées plus haut ou plus bas dans le code.
 * Et maintenant on s'attaque à la programmmation orientée objet.
 * on instancie (crée) des objets qui contiennent des propriétés (variable) 
 * et des méthodes (fonctions).
 * ces objets sont instanciés à partir de classe (plan de construction).
 * 
 * les deux mots-clé les plus importants à retenir sont :
 *      -"class" qui permet de déclarer une classe.
 *      -"new" qui permet de (créer) d'instancier une classe.
 * 
 * Par convention on mettra une majuscule à nos classes.
 */
?>
<h2>Déclaration de classe</h2>
 <em> //je déclare une classe : <br></em>
     <strong>class Chaussette{}</strong><br>
<em> //j'instancie une nouvelle  classe  chaussette:<br> </em>
<strong>$a = new Chaussette()</strong><br>;

 <?php
 //je déclare une classe :
 class Chaussette{}
 //j'instancie une nouvelle  classe  chaussette:
 $a = new Chaussette();
 ?>

 <em>//j'instancie une nouvelle  classe  chaussette:</em><br>
 <strong>$a = new Chaussette();</strong>

<?php
 /**Comme expliqué ci dessus, les classes peuvent contenir des propriétés et des 
  * methodes. Pour les déclarer, la syntaxe ne change pas des variables et 
  fonctions classiques, si ce n'est qu'elles doivent être 
  précédées d'un accesseur ( getter && setter);
        -public,
        -protected,
        -private;
    Commencons avec public, et on verra les autres par la suite
  */
  ?>
<h2>ACCESSEUR ET MUTATEUR</h2>
<p>
    la syntaxe ne change pas des variables et
      fonctions classiques, si ce n'est qu'elles doivent être
      précédées d'un accesseur <strong>(getter && setter)</strong>;<br>
            <strong>
                -public,<br>
                -protected,<br>
                -private;<br>
            </strong>
</p><hr>
<h3> -public</h3><br>

class Fruits{<br>
  public $famille = "végétal";<br>
  public function talk(){<br>
      echo "je suis un fruit ! <br>";
  }

  <?php
  class Fruits{
    public $famille = "végétal";
    public function talk(){
        echo "je suis un fruit ! <br>";
    }
  }

  /**
   * losque j'instancie une classe, pour faire appel à ses propriétés ou methodes,
   *  j'utiliserai les caractères suivants "->" 
   */
  //j'instancie ma classe
  $f = new Fruits();
  //j'appelle la méthode talk (function talk "je suis un fruit")
  $f->talk();
  //Lorque l'on fait appel à la propriété d'un objet , le $ disparait
  echo $f-> famille, "<br>";
  // je change la valeur de la propriété :
  $f->famille ="agrume";

  #---------------------THIS ET PRIVATE-------------------------#
  /**
   * Parfois on a besoin qu'une propriété n'accèpte pas n'importe quelle valeur.
   * Prenons l'exemple de l'age de qlqun, cela devra être un nombre uniquement 
   * positif.
   * 
   * Dans ce cas, on va passe la propriété en "Private", cad qu'elle ne sera 
   * accessible  qu'à l'interieur même de l'objet.
   * 
   * Pour acceder à une propriété ou methode appartenant à la class elle meme,
   *  on utilisera le mot-clé "$this" qui permet de faire apppel à l'objet lui meme
   */

 
class Humain{
    private $age;
    public function setAge(int $a):void
    {
        if($a<0)
        {
            $a = 0;
        }
        $this->age = (int)$a;
    }
    public function getAge(): int
    {
        return $this->age;
    }
   }
$h = new Humain();
   
   //$h->age=15;//ceci ne fonctionne pas car la propriété est private
   $h->setAge(-25); // l'age est de 0 car j'ai voulu mettre un nombre negatif
   echo $h->getAge(), "<br";
   ?>
<hr>
<hr>
<h3>CONSTRUCT ET DESTRUCT</h3><hr>
<?php

   #---------------------CONSTRUCT ET DESTRUCT----------------------#

   /**
    * LES METHODES __construct ET__destruct sont prédéfinies qui se lancent
    * automatiquement à la création ou à la destruction de l'objet.
*
    *Losqu'on instancie une classe, on utilise des parenthères :
    *new class();
* ces parenthèses peuvent être remplies avec des arguments comme
* une fonction.
* Ceux ci seront automatiquemnt fourni à la methode "__construct;
    */
    class Humain2{
    function __construct(string $nom)
    {
        $this->nom = $nom;
        echo $this->nom ; " est né(e). <br>";
    }
    function __destruct()
    {
        echo $this->nom , " est mort(e).  <br>";
    }
}
// on remarquera que le message de construct et de destruct apparaissent
 /*sans que je n'ai appelé de méthode*/
   $h2 = new Humain2("Maurice");
   /**
    * les variables étant automatiquement détruites en fin de script, le message 
    *de destruct apparait après mon "bonjour"
    */
   echo "bonjour <br>";
   /**
    * en detruisant moi meme la variable, je force mon message à apparaitre où je le souhaite
    */
   unset($h2);
   echo "bonsoir <br>";
   ?>
   <hr>
   <hr>
   <h3>CHAINAGE DES METHODES</h3>
   <hr>


<?php

#--------------------------------------CHAINAGE DES METHODES--------------------------#
/**
 * Si je reprend le 1er exmple, si je souhaite faire parler  mon fruit plusieurs fois, 
 * je devrais réécrire la variable qui contient mon objet à chq fois.
 */
$f->talk();
$f->talk();
$f->talk();
?>
<hr>
<?php
/**
 * mais lorsque l'on a une méthode qui ne retourne aucune valeur,
 * ce qui se fait souvent, c'est de lui retourner "$this".
 * de cette façopn l'objet va se retourner lui meme
 * On pourra zlors faire appel à une nouvelle methode ou propriété 
 * sans réécrire sa variable ni les ";" 
 */

 class Fruit2{
    public function talk(): self
    {
        echo "je suis un fruit ,<br>";
        return $this;
    }
 }
$f2 = new Fruit2();
$f2->talk()->talk()->talk();
/**
 *  ou plus joliment :
 * $f2->talk()
 *  ->talk()
 *  ->talk();
 */
?>
   <hr>
   <hr>
   <h3>CONSTANTE ET STATIC</h3>
   <hr>

<?php

#----------------------------CONSTANTE ET STATIC---------------#
/**
 * Une classe peut contenir des propriétés constantes représentées par le 
 * mot clé "const" et les methodes statiques  par "Static"
 * 
 * ces propriétés et methodes ont la particularité d'être appelables même si la
 * classe n'est pas instanciée.
 * 
 * Pour appeler une fonction static ou une constante,
 *  on remplacera le "->" par "::".
 */
class Humain3{
    public const MEMBRES = "2 bras, 2 jambes, un torse et une tête";
    public static function description()
    {
        /**
         * "$this fait référence à l'objet en cours.
         * or ici on n'instancie pas la classe, donc "$this" n'est pas utiisable.
         * on utilisera "self" pour faire référence à la classe et non à l'objet
         */
        echo "un humain possède en général".self::MEMBRES .".<br>";
    }
}
echo Humain3::MEMBRES,"<br>";
Humain3::description();
// même instanciées, elles restent utilisables.
$h3 = new Humain3();
$h3::description();
?>
   <hr>
   <hr>
   <h3>HERITAGE</h3>
   <hr>

<?php
#------------------------HERITAGE-------------------#
/**
 *  Il est possible de faire hériter des classes à de nouvelles classes.
 * La classe "enfant" héritera alors de toutes les méthodes et propriétés
 *  de son parent à l'exception de celles marquées comme "private".
 * 
 * c'est là qu'entre en jeu le dernier accesseur "protected". Il
 * aura les mêmes effets que private à la différence que les propriétés et methodes
 * seront héritées  */
class Humain4{
    private $age =20;
    protected $nom = "Maurice";
    private function loisir()
    {
        echo " j'aime le bowling depuis mes " .$this->age.  " ans <br>";
    }
    protected function talk()
    {
        echo "Bonjour, je me nomme " .$this->nom .  "<br".
        $this->loisir();
    }
}
$h4 = new Humain4();
// $h4->talk();
/**
 * Comme décrit plus haut, "protected" réagit comme "private". Donc
 * impossible d'utiliser  les methodes et propriétés proteced hors de la classe.
 * Grace au mot clé "extends" on va pouvoir faire hériter de notre classe.
 */
class Pompier extends Humain4
{
    public function presentation()
    {
        echo "je suis ". $this->nom." le Pompier. <br>";
        $this-> talk();
        //$this-> loisir();
        /**
         * "loisir()" étant private, elle n'a pas hérité et ne fonctionne pas ici.
         * Par contre je peux utiliser "$nom"et "talk" qui sont en protected et 
         * donc herités.
         */
    }
}
$p = new Pompier();
$p->presentation();

/**
 * Je peux faire hériter d'une classe qui elle meme a hérité d'une autre classe
 *  et ainsi de suite , autant de fois que je le souhaite.
 * Mais je peux interdire à une classe le fait de pouvoir hériter grace au mot clé
 * "final"
 */

 final class Apprenti extends Pompier{};
 $p2 = new Apprenti();
 $p->presentation();
/**
 * Aucun probleme avec Apprenti  qui hérite de Ponmier qui hérite de Humain4.
 * mais Apprenti étant finalje ne peux pas le faire hériter à enfant :
 */
// class enfant extends Apprenti {}
?>
   <hr>
   <hr>
   <h3>ABSTRACT</h3>
   <hr>

<?php

#-*--------------------ABSTRACT-----------------------------#
/*
    Les classes abstraites sont des classes qui ne peuvent pas être instanciées.
    Elles servent uniquement en tant qu'héritage.
    Elles peuvent être utiles si plusieurs classes doivent avoir les mêmes
    méthodes et/ou propriétés. 
    Elles commencent avec le mot clef "abstract".
*/
abstract class Humanity{
    protected $nom;
    public function talk()
    {
        echo "je me nomme " .$this ->nom."<br>";
    }
    /**
     * les classes abstraites peuvent contenir des methodes abstraites.
     * Ce sont des méthodes déclarées mais non définies.?
     * Elles servent  de plan à la construction de méthodes dans la classe
     * qui héritera.
     * 
     * Ici la classe enfant pour être valide devra contenir une méthode "setName"
     * qui prendra un argument.
     * 
     * Par contre, n'étant pas définie, chaque classe enfant pourra 
     * définir son contenu différemment.
     *
     */
    abstract public function setName(string $n);
}
    # provoque une erreur car on ne peut pas instancier une classe abstraite
    //$nope = new Humanity();
    class Policier extends Humanity{
        public function setName($n)
        {
            $this ->nom = $n;
            return $this;
        }
    }
    $po= new Policier();
    $po -> setName("Charles")
        ->talk();
?>
   <hr>
   <hr>
   <h3>INTERFACES ET TRAITS</h3>
   <hr>

<?php

#------------------------INTERFACES ET TRAITS"------------#
/**
 * Les interfaces sont semblables à une classe abstraite , à la différence 
 * qu'elles ne contiennent que des méthodes non définies et plublic.
 * Elles servent uniquement de plan pour construire une classe.
 * Elles se déclarent avec le mot clé "interface".
 */

 interface Ordinateur{
    public function youtube($url);
    public function excel();
 }
 /**
  * Les traits là aussi ressemblent aux classes abstraites,
  *si ce n'est que toutes les méthodes et propriétés sont définies.
  * On utilisera généralement la classe abstraite comme parent de plusieurs
  *classes fonctionnant de la même façon.
  *le trait se definit ave le mot clé "trait"
  */
  trait Electricity{
    protected $volt = 230;
    public function description()
    {
        echo " je me branche sur du " .$this ->volt. "volts .<br>";
    }
  }
  /**
   * pour utiliser une interface , on utilisera le motclé "implements"
   *  après le motclé "extends" s'il y en a un.
   * 
   * pour utiliser un "trait", cela  se fera à l'interieur de la classe
   * avec le mot clé "use".
   */
  class Asus implements Ordinateur
  {
    use Electricity;
    // à cause de l'interface on aura une erreur tant que les 2 methodes
    // suivantes ne sont pas définies
    function youtube($u)
    {
        echo "Je regarde $u sur youtube.";
    }
    function excel()
    {
        echo " Je fais mes comptes.";
    }
  }
  $pc = new Asus();
  $pc -> description();

  class MicroOnde{
    use Electricity;
  }
  $mo = new MicroOnde();
  $mo -> description();
  /**
   * Un ordinateur et un microndes ont des roles totalement
   *  différents mais ils partagent tous les deux le même trait.
   */

   ?>
