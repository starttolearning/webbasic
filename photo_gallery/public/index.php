<?php

require_once("../inc/initialize.php");

get_layout_template("header");


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
