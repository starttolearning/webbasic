<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Variable scope</title>
</head>
<body>
<?php
// global scope
$var = "global";


// local scope
function  local_scope(){
    $var = "local";
    echo $var ."<br/>";
}

echo $var;
echo "<br/>";
local_scope();
echo $var;
echo "<br/>";

// static
// inside the function and hold the value each time when call it
function  static_scope(){
    static $var = 2;
    echo $var ."<br/>";
    $var ++;
}

static_scope();
static_scope();
static_scope();
static_scope();





?>
</body>
</html>