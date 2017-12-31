<?php

namespace action;
//Les services de Compte
require_once("/controller/compte/AjouterCompte.class.php");
require_once("/controller/compte/ObtenirListeCompte.class.php");
require_once("/controller/compte/ObtenirCompte.class.php");
require_once("/controller/compte/SupprimerCompte.class.php");
require_once("/controller/compte/ModifierCompte.class.php");

//Espace

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
            case "rechercheCompte" :
                return new ObtenirCompte();
                break;
            case "modificationCompte" :
                return new ModifierCompte();
                break;
            default :
                return new ObtenirListeCompte();
        }
    }
}
