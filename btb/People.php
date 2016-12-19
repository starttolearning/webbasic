<?php

/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 11:48 AM
 */
class People
{


}

//$classes = get_declared_classes();
//
//foreach ($classes as $class){
//    echo $class."<br/>";
//}

if( class_exists("People")){
    echo "That class has defined";
}else{
    echo "Class not define";
}