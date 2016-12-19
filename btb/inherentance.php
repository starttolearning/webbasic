<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 1:31 PM
 */

class Car{
    var $wheels = 4;
    var $doors =4;

    function  wheelsdoors(){
        return $this->wheels + $this->doors;
    }



}

class  CompactCar extends Car{
    var $doors =2;
    function wheelsdoors()
    {
        return $this->doors + $this->wheels+100;
    }
}

$car1 = new Car();
$car2 = new CompactCar();

echo $car1->wheels . "<br/>";
echo $car1->doors ."<br/>";
echo $car1->wheelsdoors(). "<br/>";

echo $car2->wheels . "<br/>";
echo $car2->doors ."<br/>";
echo $car2->wheelsdoors(). "<br/>";

echo "Car parent: " .get_parent_class("Car") . "<br/>";
echo "CompactCar parent: " .get_parent_class("CompactCar") . "<br/>";
echo is_subclass_of("CompactCar", "Car");