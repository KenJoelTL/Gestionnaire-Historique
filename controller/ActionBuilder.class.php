<?php

namespace action;
//Les services de Compte
require_once("/controller/compte/AjouterCompte.class.php");
require_once("/controller/compte/ObtenirListeCompte.class.php");
require_once("/controller/compte/ObtenirCompte.class.php");
require_once("/controller/compte/SupprimerCompte.class.php");
require_once("/controller/compte/ModifierCompte.class.php");

//Les services d' Espace de travail
require_once("/controller/espace/AjouterEspace.class.php");
require_once("/controller/espace/ObtenirListeEspace.class.php");
require_once("/controller/espace/ObtenirEspace.class.php");
require_once("/controller/espace/SupprimerEspace.class.php");
require_once("/controller/espace/ModifierEspace.class.php");

//Les services de SousEspace
require_once("/controller/sous-espace/AjouterSousEspace.class.php");
require_once("/controller/sous-espace/ObtenirListeSousEspace.class.php");
require_once("/controller/sous-espace/ObtenirSousEspace.class.php");
require_once("/controller/sous-espace/SupprimerSousEspace.class.php");
require_once("/controller/sous-espace/ModifierSousEspace.class.php");
require_once("/controller/sous-espace/ObtenirSousEspaceParEspace.class.php");


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
            case "ajoutEspace" :
                return new AjouterEspace();
                break;
            case "listeEspace" :
                return new ObtenirListeEspace();
                break;
            case "suppressionEspace" :
                return new SupprimerEspace();
                break;
            case "rechercheEspace" :
                return new ObtenirEspace();
                break;
            case "modificationEspace" :
                return new ModifierEspace();
                break;

        // SousEspace
            case "ajoutSousEspace" :
                return new AjouterSousEspace();
                break;
            case "listeSousEspace" :
                return new ObtenirListeSousEspace();
                break;
            case "suppressionSousEspace" :
                return new SupprimerSousEspace();
                break;
            case "rechercheSousEspace" :
                return new ObtenirSousEspace();
                break;
            case "modificationSousEspace" :
                return new ModifierSousEspace();
                break;
            case "rechercheSousEspaceParEspace" :
                return new ObtenirSousEspaceParEspace();
                break;

            default :
                return new ObtenirListeCompte();
        }
    }
}
