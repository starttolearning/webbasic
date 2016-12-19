<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 1:41 PM
 */

class  Example{
    public $var1 = 1;
    private $var2 = 2;
    protected $var3 =3;

    static $total_variable = 0;

    static  function  welcome_variable(){
        Example::$total_variable ++;
    }

    function hello(){
        $output = $this->var1."<br/>";
        $output .= $this->var2 ."<br/>";
        $output .= $this->var3 ."<br/>";
        echo $output;
    }


}

$ex = new Example();

echo $ex->var1;
echo "<br/>";

echo Example::$total_variable;
echo "<br/>";

Example::$total_variable = 2;

echo Example::$total_variable;
echo "<b/>";
