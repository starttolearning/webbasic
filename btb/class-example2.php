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

$person = new Person();
$person2 = new Person();

echo  get_class($person)."<br/>";

if( is_a($person,'Person') ){
    echo "Yup, it is a Person<br/>";
}else{
    echo "Not a person<br/>";
}

$person->say_hello();

