<?php

//  /users/add.php
// Handles the adding of new users to the database

require_once("../../controllers/includes.php");

// Check if all fields are filled

// If not, add them to the database
// Redirect to home page once added

if( !empty($_POST['username']) && 
    !empty($_POST['email']) &&
    !empty($_POST['password']) &&   
    !empty($_POST['firstname']) &&  
    !empty($_POST['lastname']) &&   
    !empty($_POST['bio']) )  {
        // Create a new user object
        $user = new User;

        // Check if user already exists in the database
       
        $exists = $user->exists();
        // if they don't exist add to database
        if( empty($exists) ) {
          
            $new_user_id = $user->add();
            $_SESSION['user_logged_in'] = $new_user_id;
        } else {
            $_SESSION['create_account_msg'] = "<p class='text-danger'>User Already Exists</p>";
        }
    }

    if(!APP_DEBUG) header("Location: /");

?>