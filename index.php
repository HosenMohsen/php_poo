<?php

// Projet : Squid Game
// Auteur :  Mohsen Hosen
// J'ai utlisié la programmation orienté objet pour ce projet, j'ai créé une classe Game, 
// une classe Character, une classe Hero, une classe Enemy et une classe Utils.
// J'ai utilisé la méthode construct pour initialiser les attributs de chaque classe.
// Pour chaque classe j'ai utilisé des getters et des setters pour récupérer et modifier les attributs.






class Game {
    
    public $player;

    public function __construct($player) {

        $this->player = $player;

    }

    public function start() {
        echo "Le jeu commence";
    
    }

    public function playEncouters($enemies) {
        $enemyIndex = 0;
        
        foreach ($enemies as $enemy) {

            echo "<br>";
            echo  "Billes restantes dans la main du joueur de  départ  {$this->player->getMarbles()}";
            echo "<br>";

        $pairOuImpairHero = $this->player->choosePairOuImpaire($this->player->getMarbles());
        echo "Le choix du héro est $pairOuImpairHero";
        echo "<br>";

        $pairOuImpairEnemy = $enemy->choosePairOuImpaire($enemy->getMarbles());
        echo "Le choix de l'ennemi est $pairOuImpairEnemy {$enemy->getName()}";
        echo "<br>";
        echo "Il a {$enemy->getMarbles()} billes";
        echo "<br>";


        if ($pairOuImpairHero === $pairOuImpairEnemy) {
            $this->player->setMarbles($this->player->getMarbles() + $enemy->getMarbles() + $this->player->getBonus());
            echo "Bravo vous avez bien déviné ! Vous avez maintenant {$this->player->getMarbles()} billes";
            echo "<br>";
            echo "{$this->player->getScreem()}";
            echo "<br>";
            echo "Vous avez gagné contre l'ennemi {$enemy->getName()} qui avait {$enemy->getMarbles()} billes";
            echo "<br>";
            $enemy->setMarbles(0);

        } else {
            $this->player->setMarbles($this->player->getMarbles() - $enemy->getMarbles() - $this->player->getMalus());
            echo "Dommage, il vous reste à présent {$this->player->getMarbles()} billes";
            echo "<br>";
            echo "Vous avez perdu contre l'ennemi {$enemy->getName()} qui avait {$enemy->getMarbles()} billes";
            echo "<br>";
            $enemy->setMarbles($enemy->getMarbles() + $enemy->getMarbles() + $this->player->getMalus());

            $enemyIndex = 0;
        }
        
        $enemyIndex++;

        if($this->player->getMarbles() <= 0) {
            echo "Vous avez perdu la partie";
            echo "<br>";
            break;
        }
    }



    }
}

class Character {

    public $name;
    public $marbles;

    public function __construct($name, $marbles) { 

        $this->name = $name;
        $this->marbles = $marbles;

    }

    public function getName() {
        return $this->name;
    }

    public function getMarbles() {
        return $this->marbles;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setMarbles($marbles) {
        $this->marbles = $marbles;
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
    public $marbles;


    public function __construct($name, $marbles, $bonus, $malus, $screem_war) {  

        $this->name = $name;
        $this->marbles = $marbles;
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

   
    public function setAge( $age ) {
        $this->age = $age;
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

$facile = 5;
$difficile = 10;
$impossible = 20;
$list_difficultes = [$facile, $difficile, $impossible];
$selectedDifficulties = Utils::getRandomDifficulties($list_difficultes);

/* $pairOuImpair = $selectedHero->choosePairOuImpaire($selectedHero->getMarbles());
echo " Le choix du héros est $pairOuImpair";
 echo "<br>"; */


echo "Votre Hero sélectionné est : {$selectedHero->getName()}, vous avez  {$selectedHero->getMarbles()} billes, votre bonus est de {$selectedHero->getBonus()}, et votre malus est de  {$selectedHero->getMalus()}, pour vous motiver vous aimez bien dire {$selectedHero->getScreem()}\n";
echo "<br>";
echo "Vous allez affrontrer $selectedDifficulties ennemis différents";



echo '<br>';


$enemies = [];
for ($i = 1; $i <= $selectedDifficulties; $i++) {
    $name = "Enemy$i";
    $marbles = rand(1, 20);
    $age = rand(1, 90);
    $enemies[] = new Enemy($name, $marbles, $age);
}


$game = new Game($selectedHero);
$game->playEncouters($enemies);

/* $pairOuImpair = $Enemy->choosePairOuImpaire($Enemy->getMarbles());
echo " Le choix de l'enemi est $pairOuImpair " .  $Enemy->getName();
 echo "<br>"; */


?>