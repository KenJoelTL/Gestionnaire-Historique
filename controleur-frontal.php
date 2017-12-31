<?php
//header("Access-Control-Allow-Origin: *");
include_once("/controller/ActionBuilder.class.php");
use action\ActionBuilder;
/*
if(isset($_GET['action'])){
    $action = $_GET['action'];
    ActionBuilder::getAction($action);
}
else {
    echo "[]";
}*/

$nomAction = "ajoutCompte";
ActionBuilder::getAction($nomAction)->execute();
