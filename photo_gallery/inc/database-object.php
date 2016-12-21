<?php
require_once(LIB_PATH.DS."database.php");

class DatabaseObject{

    // Common database methods
    public static function find_all()
    {
        $sql = "SELECT * FROM ".static::$table_name;
        return static::find_by_sql($sql);
    }

    public static function find_by_id($id)
    {
        $sql = "SELECT * FROM ".static::$table_name." WHERE id = {$id} LIMIT 1";
        $result_array = static::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql = "")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    private static function instantiate($record)
    {
        $object = new static;
/*        $object->id         =$record['id'];
        $object->username   =$record["username"];
        $object->password   =$record["password"];
        $object->first_name =$record["first_name"];
        $object->last_name = $record["last_name"];*/
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    private function has_attribute($attribute)
    {
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute, $object_vars);
    }

}