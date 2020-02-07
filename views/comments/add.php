<?php

require_once('../../controllers/includes.php');


$comment_data = array(
    'error' => true 
); // start with error until data runs and it works and it changes it to to error false cause it worked

// if the comment form submited and project_id is set

if( !empty($_POST['project_id'])) {  // need a project ID to post a comment
     
    // add new comment to database
    $c_model = new Comment;
    $comment_data = $c_model->add($comment_data); // if add() works return all the commment data
}
// if there is no project id if statment doesnt run but json comment_data runs and = error true
echo json_encode($comment_data);

die();