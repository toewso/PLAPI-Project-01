<?php
require_once("../../controllers/includes.php");

// stores the love data

$love_data = array(
    'error' => true
);
   
if( !empty( $_POST['project_id'])) {
    // Add new love to db
    $love = new Love;
    // tell love_data to equal 
    $love_data = $love->add($love_data);

}

echo json_encode($love_data); // make readable by javascript
exit;


?>