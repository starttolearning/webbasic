<?php
/**
 * User: wilton
 * Date: 12/19/2016
 * Time: 3:30 PM
 */
require_once("../inc/initialize.php");

get_layout_template("header");

/*$sql = "INSERT INTO users (id, username, password, first_name, last_name) ";
$sql .="VALUES (1,'kskoglund','secretpwd','Kevin','Skoglund')";

$result = $database->query($sql);*/

$user = User::find_by_id(1);
echo $user->full_name();

echo "<hr/>";

$users  = User::find_all();
foreach ( $users as $user ){
    echo "User: ".$user->username."<br/>";
    echo "Name: " .$user->full_name()."<br>";
}

?>
<?php get_layout_template("footer"); ?>