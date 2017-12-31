<?php

namespace action;
//Les services de Compte
require_once("/controller/compte/AjouterCompte.class.php");
require_once("/controller/compte/ObtenirListeCompte.class.php");
require_once("/controller/compte/ObtenirCompte.class.php");
require_once("/controller/compte/SupprimerCompte.class.php");
require_once("/controller/compte/ModifierCompte.class.php");

//Les services d' Espace
require_once("/controller/espace/ObtenirListeEspace.class.php");

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
        // Compte
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
        // Espace
            case "listeEspace" :
                return new ObtenirListeEspace();
                break;
            default :
                return new ObtenirListeCompte();
        }
    }
}
