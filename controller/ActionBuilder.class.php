<?php

namespace action;
require_once("/controller/AjouterCompte.class.php");
require_once("/controller/ObtenirListeCompte.class.php");
require_once("/controller/SupprimerCompte.class.php");

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
                break;
            case "listeCompte" :
                return new ObtenirListeCompte();
                break;
            case "suppressionCompte" :
                return new SupprimerCompte();
                break;
            /*
            case "modificationCompte" :
                return new UpdateCompte();
                break; */
            default :
                return new AjouterCompte();
        }
    }
}
