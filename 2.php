<?php 

function cekUserName($username){
    
    $regex = "/^x[A-Z]+x\z/";
    if (preg_match($regex, $username)) {
        return true;
    }else {
        return false;
    }

}

function cekPass($password){

    $regex = "/^[a-zA-Z0-9\W]+XXX\z/";
    if (preg_match($regex, $password)) {
        return true;
    } else {
        return false;
    }
}

$username = 'xFATHURx';
$password = 'kick2xxx';

var_dump(cekUsername($username));
echo "<br/>";
var_dump(cekPass($password));

?>