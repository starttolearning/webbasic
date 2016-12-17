<?php
$conunt = "2";

// Constant defination
define('MAX_VALUE', 980);

function say_hello( ){
    echo 'Hello, world';
}

say_hello();

function simple_math( $var1, $var2 ){
    
    $add = $var1 + $var2;
    
    $subt = $var1 - $var2;
    return array($add, $subt);
}

list($add, $subt) = simple_math(20, 11);

echo 'Add result: '.$add.'<br/>';
echo 'Subt result: '.$subt.'<br/>';

$string = '$we we';
echo urlencode($string);

echo rawurlencode($string);