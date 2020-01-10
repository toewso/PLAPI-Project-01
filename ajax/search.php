<?php

require_once("../conn.php");

// if $_POST["search"] isset and is not blank or else false
$search = isset( $_POST["search"]) && $_POST["search"] != "" ? $_POST["search"] : false;
$year = isset( $_POST["year"]) ? $_POST["year"] : false;

$search = $db->real_escape_string(trim($search)); // Prevents mysql injection attackes. Checks if the string that w are getting from post has no kind of characters that could intentially cause an sql injection into server
$search_model = $db->real_escape_string(trim($search)); // Prevents mysql injection attackes. Checks if the string that w are getting from post has no kind of characters that could intentially cause an sql injection into server
$year = $db->real_escape_string($year);

if($search || $year) {
    $search_sql = "SELECT * FROM cars
                   WHERE nickname LIKE '%$search%' "; 

    if($year != 0) {
        $search_sql .= " AND year = $year";
    }

} else {
    $search_sql = "SELECT * FROM cars";
}

if($search || $year) {
    $search_sql = "SELECT * FROM cars
                   WHERE model LIKE '%$search_model%' "; 

    if($year != 0) {
        $search_sql .= " AND year = $year";
    }

} else {
    $search_sql = "SELECT * FROM cars";
}




$result = $db->query($search_sql); // open database connection

$cars = array();

while($row = $result->fetch_assoc()) {
    $cars[] = $row; // append row to the $cars array
}

$db->close(); // close database connection, helps speed up servers

echo json_encode($cars); // return results in JavaScrip Object-Notation. structure data for js to read it as an object





?>