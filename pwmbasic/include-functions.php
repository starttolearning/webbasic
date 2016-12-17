<?php
/**
 * Created by PhpStorm.
 * User: wilton
 * Date: 12/16/2016
 * Time: 10:48 AM
 */

function redirect_to( $location ){
    header("Location: {$location}");
    exit;
};

