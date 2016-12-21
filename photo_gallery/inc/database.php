<?php
/**
 * Class MySQLDatabase
 * User: wilton
 * Date: 12/19/2016
 * Time: 3:50 PM
 */

require_once(LIB_PATH.DS."config.php");

class MySQLDatabase
{
    private $connection;

    function __construct()
    {
        $this->open_connection();
    }

    public function open_connection()
    {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            die("Database connection failed" .
                mysqli_connect_error() .
                "(" . mysqli_connect_errno() . ")"
            );
        }
    }

    public function close_connection()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    public function escape_value($string)
    {
        return mysqli_real_escape_string($this->connection, $string);
    }

    private function confirm_query($result_set)
    {
        if (!$result_set) {
            die("Data query failed");
        }
    }

    public function fetch_array($result_set)
    {
        return mysqli_fetch_array($result_set);
    }

    public function num_rows()
    {
        return mysqli_num_rows($this->connection);
    }

    public function insert_id()
    {
        return mysqli_insert_id($this->connection);
    }

    public function affect_rows()
    {
        return mysqli_affected_rows($this->connection);
    }


}

$database = new MySQLDatabase();