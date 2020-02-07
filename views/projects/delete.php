<?php
require_once("../../controllers/includes.php"); // includes database files and users etc

$p_model = new Project;
$p_model->delete();

header("Location: /");

?>