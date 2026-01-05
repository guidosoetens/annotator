<?php

$encode_factor = 1337;

$USER_ENCR_KEY = "USER_ENCR_KEY";

function xorEncrypt($input, $key) {
    $output = '';
    for($i=0; $i<strlen($input); $i++ )
        $output .= $input[$i] ^ $key[$i % strlen($key)];
    return $output;
}

function encode_index($idx, $key) {

    global $encode_factor;

    $code = "" . (($idx + 1) * $encode_factor);
    $alpha = "";
    $cs = str_split($code);
    foreach ($cs as $c)
        $alpha .= chr(ord("a") + intval($c));
    return bin2hex(xorEncrypt($alpha, $key));
}

function decode_index($str, $key) {
    
    global $encode_factor;

    $code = xorEncrypt(hex2bin($str), $key);
    $cs = str_split($code);
    $num_str = "";
    foreach ($cs as $c)
        $num_str .= (ord($c) - ord("a"));
    $num = intval($num_str);
    if($num % $encode_factor != 0)
        return -1;
    return $num / $encode_factor - 1;
}

function cleanHexInput($s) {
    return preg_replace("/[^a-f0-9-]+/","", $s);
}

//str = str.replace(/[^a-z0-9\.\?\!,-\s]/gim,"");
function cleanTextInput($s) {
    return strval(preg_replace("/[^a-zA-Z0-9- .,?!]+/","", $s));
}

?>