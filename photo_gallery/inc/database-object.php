<?php
require_once(LIB_PATH . DS . "database.php");

class DatabaseObject
{

    // Common database methods

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    /*
      The basic database operation: CREATE
    */
    public function create()
    {
        global $database;
        $attributes = static::sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " ( ";
        $sql .= join(", ", array_keys($attributes));
        $sql .= " ) VALUES ( '";
        $sql .= join("', '", array_values($attributes));
        $sql .= "' )";
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    /*
      The basic database operation: DELETE
    */
    public function delete( )
    {
        global $database;
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id= " . $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        var_dump($sql);
        $database->query($sql);
        return ($database->affect_rows() == 1) ? true : false;
    }

    /*
      The basic database operation: UPDATE
    */
    public function update()
    {
        global $database;
        $attributes = static::sanitized_attributes();
        $sql = "UPDATE " . static::$table_name . " SET ";
        $attributes_paris = array();
        foreach ($attributes as $key => $value) {
            $attributes_paris[] = "{$key} = {$value}";
        }
        $sql .= join(", ", $attributes_paris);
        $sql .= " WHERE id= " . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affect_rows() == 1) ? true : false;
    }

    /*
      The basic database operation: RETRIEVE
    */
    public static function find_all()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::find_by_sql($sql);
    }

    public static function find_by_id($id)
    {
        global $database;
        $id = $database->escape_value($id);
        $sql = "SELECT * FROM " . static::$table_name . " WHERE id = {$id} LIMIT 1";
        $result_array = static::find_by_sql($sql);
        return !( empty($result_array) ) ? array_shift($result_array) : false;
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

    private function attributes()
    {
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    private function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

}
