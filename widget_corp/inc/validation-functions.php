<?php

$errors = array();


/**
 * Function replace the underscore with the space
 * @param $fieldname
 * @return mixed|string
 */
function fieldname_as_text($fieldname)
{
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
}


/**
 * Function check if the variable presence
 * @param $value
 * @return bool
 */
function has_presence($value)
{
    return isset($value) && $value !== "";
}

/**
 * Function validation for the presence of fields
 * @param $required_fields
 */
function validate_presences($required_fields)
{
    global $errors;
    foreach ($required_fields as $field) {
        $value = $_POST["$field"];
        if (!has_presence($value)) {
            $errors[$field] = fieldname_as_text($field) . " can not be blank";
        }
    }
}

/**
 * Function check field has max length
 * @param $value
 * @param $max
 * @return bool
 */
function has_max_len($value, $max)
{
    return strlen($value) <= $max;
}

/**
 * Function check fields with the max length loop
 * @param $fields_with_max_lenghts
 */
function validate_max_lengths($fields_with_max_lenghts)
{
    global $errors;
    foreach ($fields_with_max_lenghts as $field => $max) {
        $value = trim($_POST[$field]);
        if (!has_max_len($value, $max)) {
            $errors[$field] = fieldname_as_text($field) . " is too long";
        }
    }
}

function has_inclusion_in($value, $set)
{
    return in_array($value, $set);
}
