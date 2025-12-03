<?php
$title = '07 - Overwrite Method';
$description = 'Redefining a parent class`s method in the child class.';

include_once 'template/header.php';
echo "<section>";

class VideoGame {
    protected $name;
    protected $platform;
    protected $year;

    public function __construct($name, $platform) {
        $this->name = $name;
        $this->platform = $platform; 
    }
}

class Games extends VideoGame {
    public function __construct($name, $platform, $year) {
        parent::showVideoGame();
        $this->year = $year;
    }
    public function showVideoGame() {
        echo "<ul><li> Name: {$this->name} <br>
                       Platform: {$this->platform} <br>
                       Year: {$this->year} </li></ul>";
    }
}

$gn = new Games('Halo Infinite', 'Xbox Series X', 2021);
$gn->showVideoGame();

include_once 'template/footer.php';