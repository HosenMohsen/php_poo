<?php





class Game {
    
    

public function __construct() {

    }
}

class Character {

    public $name;
    public $nbilles;

    public function __construct($name, $nbilles) { 

        $this->name = $name;
        $this->nbilles = $nbilles;

    }

    public function getName() {
        return $this->name;
    }

    public function getNbilles() {
        return $this->nbilles;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setNbilles($nbilles) {
        $this->nbilles = $nbilles;
    }


    public function choosePairOuImpaire($billesRestant) {
        $randomBilles = rand(1, $billesRestant);

        if ($randomBilles % 2 == 0) {
            return "pair";
     }  
     else {
        return  "impair";
    }
    }

}


class Hero extends Character {

    public $bonus;
    public $malus;
    public $screem_war;
    public $name;
    public $nbilles;


    public function __construct($name, $nbilles, $bonus, $malus, $screem_war) {  

        $this->name = $name;
        $this->nbilles = $nbilles;
        $this->bonus = $bonus;
        $this->malus = $malus;
        $this->screem_war = $screem_war;

    }

    public function getBonus() {
        return $this->bonus;
    }

    public function getMalus() {
        return $this->malus;
    }

    public function getScreem() {
        return $this->screem_war;
    }

    public function setBonus($bonus) {
        $this->bonus = $bonus;
    }

    public function setMalus($malus) {
        $this->malus = $malus;
    }

    public function setScreem($screem_war) {
        $this->screem_war = $screem_war;
    }

/*    private function checkPair(){
       $this->getMarbles();
       if ($this->getName() % 2 == 0) {
        return true;
    } 
    return false;
} */
}

class Enemy extends Character {

    public $age;
    public $marbles;
    public $name;

    public function __construct($name, $age, $marbles) {

        $this->age = $age;
        $this->name = $name;
        $this->marbles = $marbles;

    }

    public function getAge(){
        return $this->age;
    }

    public function getMarbles(){
        return $this->marbles;
    }

    public function setAge( $age ) {
        $this->age = $age;
    }

    public function setMarbles( $marbles ) {
        $this->marbles = $marbles;
    }

}


abstract class Utils {

    public $random_difficulties;
    
    
    public function __construct($random_difficulties) {
   
        $this->random_difficulties = $random_difficulties;
          
    }

   

 
    public function setRandomDifficulties( $random_difficulties ) {
        $this->random_difficulties = $random_difficulties;
    }

    public static function getRandomHero($heroes) {
        $randomHeroIndex = array_rand($heroes);
        return $heroes[$randomHeroIndex]    ;
    }


    public static function getRandomDifficulties($list_difficultes){
        $randomDifficultiesIndex = array_rand($list_difficultes);
        return $list_difficultes[$randomDifficultiesIndex] ;
    }

}


$hero1 = new Hero("Seong Gi-hun", 15, 1, -2, "QUE LA WIN");
$hero2 = new Hero("Kang Sae-byeok", 25, 2, -1, "ALLEZZZ, WINNN");
$hero3 = new Hero("Cho Sang-woo", 35, 3, 0, "POUR LA VICTOIRE");

$heroes = [$hero1, $hero2, $hero3];
$selectedHero = Utils::getRandomHero($heroes);

$pairOuImpair = $selectedHero->choosePairOuImpaire($selectedHero->getNbilles());
echo " Le choix du héros est $pairOuImpair";
 echo "<br>";

$facile = 5;
$difficile = 10;
$impossible = 20;
$list_difficultes = [$facile, $difficile, $impossible];
$selectedDifficulties = Utils::getRandomDifficulties($list_difficultes);
echo $selectedDifficulties;
echo '<br>';



for ($i = 1; $i <= $selectedDifficulties; $i++) {
    $name = "Enemy$i";
    $marbles = rand(1, 20);
    $age = rand(1, 90);
    $Enemy = new Enemy($name, $marbles, $age);
    echo $Enemy->getName();
   /*  echo  "$name = nex, Marbles: $marbles, Age: $age"; */
    echo "<br>";
}

echo "Hero sélectionné: {$selectedHero->getName()}, Billes: {$selectedHero->getNbilles()}, Bonus: {$selectedHero->getBonus()}, Malus: {$selectedHero->getMalus()}, Cri de guerre: {$selectedHero->getScreem()}\n";

?>