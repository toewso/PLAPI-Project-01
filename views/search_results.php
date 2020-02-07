<?php

require_once('../controllers/includes.php');

/* if query starts with @
    Get user model and return user results
else
    Get project model and return project results
*/

$query = $_GET['search'];
if($query[0] == "@") {
    $u_model = new User;
    $user_results = $u_model->get_all(); 

    echo json_encode($user_results);

} else {
    $p_model = new Project;
    $project_results = $p_model->get_all();  // run to list off all projects - go into function and see if a search query is being run

    echo json_encode($project_results);
}
