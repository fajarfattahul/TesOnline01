<?php 

function ganti($par1, $par2){
    
    $vowel = array('a', 'i', 'u', 'e', 'o');

    if (in_array($par2, $vowel)) {
        echo str_replace($vowel, $par2, $par1);
    } else {
        echo "Tidak ada huruf vokal!";
    }
}

$par1 = "orang jahat adalah orang baik yang tersakiti";
$par2 = 'i';

ganti($par1, $par2);

?>