<?php
$title = '04 - Collaboration';
$description = 'Objects working together by calling each other`s methods.';

include_once 'template/header.php';
echo "<section>";

class Evolve {
    public function evolvePokemon($origin, $evolution) {
        echo "<ul><li>$origin to ➡️ $evolution</li></ul>";

    }
}

class Pokemon {
    private $origin;
    private $evolution;
    private $collaboration;

    public function __construct($origin, $evolution){
        $this->origin = $origin;
        $this->evolution = $evolution;
        //collaboration
        $this->collaboration = new Evolve;
    }

    public function nextLevel(){
        $this->collaboration->evolvePokemon($this->origin, $this->evolution);
    }
}

$pk1 = new Pokemon('Pichu', 'Pikachu');
$pk1->nextLevel();
$pk1 = new Pokemon('Pikachu', 'Raichu');
$pk1->nextLevel();

$pk2 = new Pokemon('Squartle', 'Wartortle');
$pk2->nextLevel();
$pk2 = new Pokemon('Wartortle', 'Blastoise');
$pk2->nextLevel();

$pk3 = new Pokemon('Bulbasur', 'Ivysaur');
$pk3->nextLevel();
$pk3 = new Pokemon('Ivysaur', 'Venusaur');
$pk3->nextLevel();


include_once "template/footer.php";