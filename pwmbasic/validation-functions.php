<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/16/2016
 * Time: 12:04 PM
 */

function has_presence( $value ){
    return isset( $value ) && $value !== "";
}

function has_max_len($value, $max){
    return strlen($value) <= $max;
}

function has_inclusion_in($value, $set){
    return in_array($value, $set);
}

function validate_max_lengths( $fields_with_max_lenghts){
    global $errors;
    foreach ( $fields_with_max_lenghts as $field => $max){
        $value = trim($_POST[$field]);
        if( ! has_max_len($value, $max)){
            $errors[$field] =ucfirst($field)." is too long";
        }
    }
}

function form_errors( $errors = array()){
    $output = "";
    if( ! empty($errors) ){
        $output .= '<div class="error">';
        $output .= 'Please fix the following errors: ';
        $output .= '<ul>';
        foreach ($errors as $key => $value){
            $output .= '<li>'.$value.'</li>';
        }
        $output .='</ul>';
        $output .='</div>';
    }
    return $output;
}