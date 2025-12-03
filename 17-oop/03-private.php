<?php
$title    = '03-private';
$description = 'Private: Restricts property or method access to only within its class.';

include_once 'template/header.php';
echo "<section>";


class RenderTable {
    private $nr; //number of rows
    private $nc; //Number of columns

    public function __construct($nr, $nc) {
        $this->nr = $nr;
        $this->nc = $nc;

        // Acces Methods Private
        $this->renderTableHeader();
        $this->renderTableBody();
        $this->renderTableFooter();
    }

    private function renderTableHeader(){
        echo "<h3>Table ($this->nr x $this->nc)</h3>";
        echo "<table>";
    }
    private function renderTableBody(){
        for ($r=1; $r <= $this->nr ; $r++) { 
            echo "<tr>";
            for ($c=0; $c < $this->nc ; $c++) { 
                echo "<td>f$r c$c</td>";
            }
        }
        echo "</tr>";
    }
    private function renderTableFooter(){
        echo "</table> <br>" ;
    }

}
$rt = new RenderTable(5, 5);
echo "<br>";
$rt = new RenderTable(3, 3);


include_once 'template/footer.php';