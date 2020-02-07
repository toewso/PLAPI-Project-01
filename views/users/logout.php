<?php
session_start();
session_destroy();
// check if the cookie array has anything in it, if it has an account.  If it does we unset it, wipe its values
if(count($_COOKIE) > 0 ) {
    unset($_COOKIE['user_logged_in']);
    setcookie("user_logged_in", null, -1, "/"); // set cookie (user logged in) to have the value of nothing. -1 is removing the time, setting it to be null permemetly
}
header("Location: /");

?>