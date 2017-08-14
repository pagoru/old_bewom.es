<?php

function encrypt($password) {

    $fp = fopen('/dev/urandom', 'r');
    $randomString = fread($fp, 32);
    fclose($fp);
    $salt = '$6$'.base64_encode($randomString);

    $hashed = crypt($password, $salt);

    return $hashed;

}

function pass_verify($password, $hashedPassword) {

    if(crypt($password, $hashedPassword) == $hashedPassword){
    	
        return 1;

    }

    return 0;

}

?>