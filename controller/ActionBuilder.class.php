<?php

namespace action;
require_once("/controller/AjouterCompte.class.php");

/**
 * Description of ActionBuilder
 *
 * @author Joel
 */
class ActionBuilder {
    public static function getAction($nom){
        switch ($nom) {/*
            case "test" :
                return new PageTest();
                break; */
            case "ajoutCompte" :
                return new AjouterCompte();
                break; /*
            case "modificationCompte" :
                return new UpdateCompte();
                break; */
            default :
                return new AjouterCompte();
        }
    }
}
