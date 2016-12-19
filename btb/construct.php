<?php

/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/19/2016
 * Time: 3:01 PM
 */
class Table
{
    public $leges;
    static public $total_tables;
    function __construct()
    {
        $this->leges =4;
        self::$total_tables ++;
    }


}

$table = new Table();
ECHO $table->leges."<br/>";
$table1 = new Table();
echo Table::$total_tables;

$table2 = new Table();
echo Table::$total_tables;