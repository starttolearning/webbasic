<?php

/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 11:48 AM
 */
class Person
{
    function say_hello(){
        echo "Hello from inside a class";
    }

}

/*$classes = get_declared_classes();

foreach ($classes as $class){
    echo $class."<br/>";
}

if( class_exists("Person")){
    echo "That class has defined";
}else{
    echo "Class not define";
}*/

$methods = get_class_methods("Person");
foreach ( $methods as $method){
    echo $method . "<br/>";
}


if( method_exists("Person","say_hello")){
    echo "That Method has defined";
}else{
    echo "Method not define";
}


