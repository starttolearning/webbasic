<?php
/**
 * CMS - Widget Corp
 * User: wilton
 * Date: 12/16/2016
 * Time: 6:11 PM
 * General functions file
 */

/**
 * Redirect function
 * @param $location
 */
function redirect_to($location)
{
    header("Location: {$location}");
    exit;
}

/**
 * @param $string
 * @return string
 */
function mysqli_prep($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

/**
 * confirm_query function
 * @param $result_set
 */
function confirm_query($result_set)
{
    if (!$result_set) {
        die("Data query failed");
    }
}

/**
 * Function Retrieve all the admins
 * @return bool|mysqli_result
 */
function find_all_admins()
{
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC ";
    $admin_sets = mysqli_query($connection, $query);
    confirm_query($admin_sets);
    return $admin_sets;
}

/**
 * Function Retrieve the admin user by id
 * @param $admin_id
 * @return array|null
 */
function find_admin_by_id($admin_id)
{
    global $connection;
    // Escape the sql injection
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "Limit 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);

    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
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

function find_admin_by_name($username)
{
    global $connection;
    // Escape the sql injection
    $safe_admin_name = mysqli_real_escape_string($connection, $username);
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_admin_name}' ";
    $query .= "Limit 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);

    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function attempt_login($username, $password ){
    $admin = find_admin_by_name($username);
    if($admin){
        // Check the authentication
        if( password_check($password,$admin["hashed_password"])){
            // check passed
            return $admin;
        }else{
            return false;
        }

    }else{
        return false;
    }
}

function logged_in(){
    return isset( $_SESSION["admin_id"] );
}

function confirm_logged_in(){
    if( !logged_in() ){
        redirect_to("login.php");
    }
}


/**
 * @return bool|mysqli_result
 */
function find_all_subjects($public = true)
{
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    if ($public) {
        $query .= "WHERE visible = 1 ";
    }
    $query .= "ORDER BY position ASC ";
    $subject_sets = mysqli_query($connection, $query);
    confirm_query($subject_sets);
    return $subject_sets;
}

/**
 *
 * @param $subject_id
 * @param $public = false
 * @return bool|mysqli_result
 * `
 */
function find_pages_for_subject($subject_id, $public = false)
{
    global $connection;
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE subject_id = {$safe_subject_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $page_sets = mysqli_query($connection, $query);
    confirm_query($page_sets);
    return $page_sets;
}

/**
 * Function find the subject by it's id
 * @param $subject_id
 * @return array|null
 */
function find_subject_by_id($subject_id)
{
    global $connection;
    // Escape the sql injection
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= "Limit 1";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);

    if ($subject = mysqli_fetch_assoc($subject_set)) {
        return $subject;
    } else {
        return null;
    }

}

/** Function find pages by the page id
 * @param $page_id
 * @return array|null
 */
function find_page_by_id($page_id, $public = false)
{
    global $connection;
    // Escape the sql injection
    $safe_page_id = mysqli_real_escape_string($connection, $page_id);
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";

    $page_set = mysqli_query($connection, $query);

    confirm_query($page_set);

    if ($page = mysqli_fetch_assoc($page_set)) {
        return $page;
    } else {
        return null;
    }
}


function find_default_page_by_subject_id($subject_id, $public)
{
    $page_set = find_pages_for_subject($subject_id, $public);
    if ($fist_page = mysqli_fetch_assoc($page_set)) {
        return $fist_page;
    } else {
        return null;
    }
}


function find_current_subject_or_page($public = false)
{
    global $current_subject;
    global $current_page;
    if (isset($_GET["subject"])) {
        $current_subject = find_subject_by_id($_GET["subject"]);
        if ($public) {
            $current_page = find_default_page_by_subject_id($current_subject["id"], $public);
        } else {
            $current_page = null;
        }
    } else if (isset($_GET["page"])) {
        $current_page = find_page_by_id($_GET["page"], $public);
        $current_subject = null;
    } else {
        $current_subject = null;
        $current_page = null;
    }
}


function wc_form_errors($errors = array())
{
    $output = "";
    if (!empty($errors)) {
        $output .= '<div class="error">';
        $output .= 'Please fix the following errors: ';
        $output .= '<ul>';
        foreach ($errors as $key => $value) {
            $output .= '<li>' . $value . '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
    }
    return $output;
}

/**
 * @param array $options
 * @return string
 */
function navigations($options = array())
{
    $output = "<ul class=\"subjects\">";
    $subject_sets = find_all_subjects($options["public"]);
    while ($subject = mysqli_fetch_assoc($subject_sets)) {
        $output .= "<li ";
        if ($options["subject_array"] && $subject["id"] == $options["subject_array"]["id"]) {
            $output .= "class=\"selected\"";
        }
        $output .= ">";
        $output .= "<a href=\"";
        if ($options["public"]) {
            $output .= "index";
        } else {
            $output .= "manage-content";
        }
        $output .= ".php?subject=" . urlencode($subject["id"]) . "\">";
        $output .= htmlentities($subject["menu_name"]) . "</a>";
        if ($options["public"]) {
            if ($options["subject_array"]["id"] == $subject["id"] || $options["page_array"]["subject_id"] == $subject["id"]) {
                $page_sets = find_pages_for_subject($subject["id"], $options["public"]);
                $output .= "<ul class=\"pages\">";
                while ($pages = mysqli_fetch_assoc($page_sets)) {
                    $output .= "<li ";
                    if ($options["page_array"] && $pages["id"] == $options["page_array"]["id"]) {
                        $output .= "class=\"selected\"";
                    }
                    $output .= ">";
                    $output .= "<a href=\"index.php?page=" . urlencode($pages["id"]) . "\">" . htmlentities($pages["menu_name"]) . "</a></li>";
                }
                mysqli_free_result($page_sets);
                $output .= "</ul> ";
            }
        } else {
            $page_sets = find_pages_for_subject($subject["id"]);
            $output .= "<ul class=\"pages\">";
            while ($pages = mysqli_fetch_assoc($page_sets)) {
                $output .= "<li ";
                if ($options["page_array"] && $pages["id"] == $options["page_array"]["id"]) {
                    $output .= "class=\"selected\"";
                }
                $output .= ">";
                $output .= "<a href=\"manage-content.php?page=" . urlencode($pages["id"]) . "\">" . htmlentities($pages["menu_name"]) . "</a></li>";
            }
            mysqli_free_result($page_sets);
            $output .= "</ul> ";
        }
        $output .= "</li> ";
    }
    mysqli_free_result($subject_sets);
    $output .= "</ul>";
    return $output;
}
