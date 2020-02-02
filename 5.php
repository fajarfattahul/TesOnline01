<?php 

function printSquare($a){
    for ($i=1; $i <= $a; $i++) { 
        for ($j=1; $j <= $a; $j++) { 
            if ($j == 1 || $i == 1 || $j == $a || $i == $a) {
                echo '* ';
            } else {
                echo "<a style='color:white'>* </a>";
            }
        }
        echo '<br/>';
    }
}

printSquare(4);

?>