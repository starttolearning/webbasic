<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 3:09 PM
 */

class Beverage{
    public $name;

    public function __construct()
    {
        echo "New beverage was created<br>";
    }

    public function __clone()
    {
        echo "Existing beverage was cloned<br/>";
    }

}

$a  = new Beverage();
$a->name = "coffee";

$b = $a;
$b->name ="tea";
echo $a->name;
echo "<br/>";

$c = new Beverage();
$c->name = "Orange";
echo $c->name;
echo "<br/>";

$d = clone $a;
$d->name= "Juice";
echo $a->name;
echo "<br/>";
echo $d->name;


