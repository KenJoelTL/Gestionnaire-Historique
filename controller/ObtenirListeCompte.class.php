<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/CompteDAO.class.php');
require_once('/model/Compte.class.php');
require_once('/model/Liste.class.php');
use model\dao\Connexion;
use model\dao\CompteDAO;
use model\Compte;
use model\Liste;
/**
 * Description of ObtenirListeCompte
 * service qui permet d'obtenir la liste de tous les comptes
 * @author Joel
 */
class ObtenirListeCompte implements Action {

    public function execute() {

        $connexion = Connexion::getInstance();
        $compteDao = new CompteDAO();
        $compteDao->setCnx($connexion);
        $liste = $compteDao->findAll();
        Connexion::close();

        $compteJSON ='[';
        while($liste->next()){

            $compteJSON .=
                ' { '.
                    '"id":"'.$liste->current()->getId().'",'.
                    '"courriel":"'.$liste->current()->getCourriel().'",'.
                    '"motPasse":"'.$liste->current()->getMotPasse().'"'.
                ' } ';
            if($liste->hasNext()){
                $compteJSON.= ',';
            }
        }

        echo $compteJSON.=']';
    }

}
