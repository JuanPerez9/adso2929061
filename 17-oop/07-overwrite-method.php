<?php
$title = '07 - Overwrite Method';
$description = 'Redefining a parent class`s method in the child class.';

include_once 'template/header.php';
echo "<section>";

class VideoGame {
    protected $name;
    protected $platform;

    public function __construct($name, $platform) {
        $this->name = $name;
        $this->platform = $platform; 
    }
    public function showVideoGame() {
        return "<ul><li> Platform: {$this->platform} </li></ul>";
    }
}

class Game extends VideoGame {
    public function showVideoGame() {
        echo "<ul><li> Name: {$this->name} <br>";
        parent::showVideoGame();
    }
}

$gn = new Game('Hollow Knight: Silk Song', 'Nintendo Switch');
$gn->showVideoGame();


include_once 'template/footer.php';