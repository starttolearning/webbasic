<?php
/**
 * CMS - Widget Corp
 * User: wilton
 * Date: 12/16/2016
 * Time: 6:11 PM
 * functions file
 */

//confirm_query function
function confirm_query($result_set)
{
    if (!$result_set) {
        die("Data query failed");
    }
}

/**
 * @return bool|mysqli_result
 */
function find_all_subjects()
{
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "ORDER BY position ASC ";

    $subject_sets = mysqli_query($connection, $query);

    confirm_query($subject_sets);
    return $subject_sets;
}

/**
 * @param $subject_id
 * @return bool|mysqli_result
 */
function find_pages_for_subject($subject_id)
{
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE subject_id = {$subject_id} ";
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
function get_subject_name_by_id( $subject_id ) {
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= "Limit 1";

    $subject_set = mysqli_query($connection, $query);

    confirm_query($subject_set);

    if( $subject = mysqli_fetch_assoc($subject_set) ){
        return $subject;
    }else{
        return null;
    }

}

/** Function find pages by the page id
 * @param $page_id
 * @return array|null
 */
function get_page_by_id( $page_id ){
    global $connection;

    $safe_page_id = mysqli_real_escape_string($connection, $page_id);
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    $query .="LIMIT 1";

    $page_set = mysqli_query($connection, $query);

    confirm_query($page_set);

    if( $page = mysqli_fetch_assoc($page_set) ){
        return $page;
    }else{
        return null;
    }
}


/**
 * @param $selected_subject_id int From the $_GET array
 * @param $selected_page_id int From the $_GET array
 * @return string
 */
function navigation($selected_subject_id, $selected_page_id)
{
    $output = "<ul class=\"subjects\">";
    $subject_sets = find_all_subjects();
    while ($subject = mysqli_fetch_assoc($subject_sets)) {
        $output .= "<li ";
        if ($subject["id"] == $selected_subject_id) {
            $output .= "class=\"selected\"";
        }
        $output .= ">";
        $output .= "<a href=\"manage-content.php?subject=" . urlencode($subject["id"]) . "\">";
        $output .= $subject["menu_name"] . "</a>";
        $page_sets = find_pages_for_subject($subject["id"]);
        $output .= "<ul class=\"pages\">";
        while ($pages = mysqli_fetch_assoc($page_sets)) {
            $output .= "<li ";
            if ($pages["id"] == $selected_page_id) {
                $output .= "class=\"selected\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage-content.php?page=" . urlencode($pages["id"]) . "\">" . $pages["menu_name"] . "</a></li>";
        }
        mysqli_free_result($page_sets);
        $output .= "</ul></li> ";
    }
    mysqli_free_result($subject_sets);
    $output .= "</ul>";
    return $output;
}