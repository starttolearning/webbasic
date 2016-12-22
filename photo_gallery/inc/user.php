<?php
// If it's going to need the database , then it is
// probably smart to require it before we start
require_once(LIB_PATH . DS . "database.php");


class User extends DatabaseObject
{

    protected static $table_name = "users";
    protected static $db_fields = array("id", "username", "password", "first_name", "last_name");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public static function authenticate($username, $password)
    {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username='{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

}

/**
 * Function  Password encrypt
 * @param $password
 * @return string
 */
function password_encrypt($password)
{
    $hash_format = "$2y$10$";  // Tell PHP to use Blowfish with a "cost" of 10
    $salt_length = 22; // Blowfish should be 22-characters or more
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;

    $hash = crypt($password, $format_and_salt);
    return $hash;

}

/**
 * Function generate a specified length salt
 * @param $salt_length
 * @return string
 */
function generate_salt($salt_length)
{
    // Not 100% unique, not 100% random, but good enough for a salt
    // MD5 return 32 characters
    $unique_random_string = md5(uniqid(mt_rand()), true);

    // Valid characters for a salt ar [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    // But now '+' which is valid in base64 encoding
    $modify_base64_string = str_replace('+', '.', $base64_string);

    // Truncate string to correct length
    $salt = substr($modify_base64_string, 0, $salt_length);

    return $salt;
}

/**
 * Function user login checking
 * @param $password
 * @param $existing_hash
 * @return bool
 */
function password_check($password, $existing_hash)
{
    // Existing hash contains format and salt at start
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {
        return true;
    } else {
        return fals;
    }
}
