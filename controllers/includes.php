<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if( !isset($_SESSION)) session_start();



// manages includsion of all controller and model files

// Create a constant variable to hold the path to the root directory of the project
// $_SERVER["DOCUMENT_ROOT"];

//DEFINE CONSTANT APP_ROOT
define('APP_ROOT', substr(__DIR__, 0, strrpos(__DIR__, DIRECTORY_SEPARATOR)) ); // strrpos extra r finds the last one
//takes entire directory searches from begining finds controller then use everything after the slash


define ('APP_NAME', 'culture jam'); // so you don't have to change it indiviually through all pages

define('APP_DEBUG', false);

// how to properly link to files so no broken links
require_once(APP_ROOT . "/controllers/db.php");
require_once(APP_ROOT . "/controllers/util.php");


// Automatically include all files in the /models folder, these models will have a class associated with them
spl_autoload_register(function($class){
    // $class = User
    // add any /php files ext with the class call name to match, but most be lower case
    $filename = strtolower($class) . '.php'; // this will return User > user, concatonate .php

    // check if the class file exists and is in the model folder
    if( file_exists( APP_ROOT . '/models/' . $filename )){
        require_once( APP_ROOT . '/models/' . $filename );
    }



});

if(!empty($_COOKIE['user_logged_in'])) {
    $_SESSION['user_logged_in'] = $_COOKIE['user_logged_in']; // if the cookie is set then put it into the session

}

if(!empty($_SESSION['user_logged_in'])) {
    $user = new User;
    $current_user = $user->get_by_id(($_SESSION['user_logged_in']) ); // array that stores all user data
}




?>