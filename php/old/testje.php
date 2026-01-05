<?php

include 'encrypt.php';


echo 'A</br>';
$str = "abn356c cdcd [].,@#$%^^&:;'<>/`!? dez";
echo 'B</br>';
$str2 = cleanTextInput($str);
echo 'C</br>';
echo "{$str}</br>{$str2}</br>";

if (class_exists('SQLite3')) {
    echo 'SQLite3 extension loaded';
 }


?>