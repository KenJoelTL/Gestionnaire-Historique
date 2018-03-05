<?php
//To allow this file to be read from other domains
header("Access-Control-Allow-Origin: *");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
include_once("/controller/ActionBuilder.class.php");
include_once("/controller/RequestAware.interface.php");
use action\ActionBuilder;
use action\RequestAware;

if(isset($request->action) || isset($_GET["action"])){
    if(isset($request->action)){
        $nomAction = $request->action;
    }
    elseif (isset($_GET["action"])) {
        $nomAction = $_GET["action"];
        $request = $_GET;
    }

    $action = ActionBuilder::getAction($nomAction);

    //injection de la requete à l'action qui en a besoin
    if($action instanceof RequestAware){
        $action->setRequest($request);
    }

    $action->execute();
}
else {
    echo '[]';
}
