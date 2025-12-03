<?php
$title = '06 - Extends';
$description = 'Keyword for a class to inherit properties and methods from another.';

include_once 'template/header.php';
echo "<section>";

class Operation {
    protected $num1;
    protected $num2;

    public function __construct($num1, $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }
}

class Addition extends Operation {
    public function showResult() {
        return "<ul><li> {$this->num1} + {$this->num2} </li></ul>";
    }
}




include_once 'template/footer.php';