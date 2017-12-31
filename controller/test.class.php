<?php

namespace action;
require_once '/controller/Action.interface.php';
require_once '/model/Compte.class.php';
require_once '/model/DAO/CompteDAO.class.php';
use model\Compte;
use model\dao\compte\CompteDAO;
/**
 * Description of Test
 *
 * @author Joel
 */
class Test implements Action{

    public function execute() {
        //echo"{ truc : Ajout réussie !}";
        $compte = new Compte();
        $compte->setId(0);
        $compte->setCourriel("test@mail.com");
        $compte->setMotPasse("test");

        $compteJSON =
            '{ '.
                '"id":"'.$compte->getId().'",'.
                '"courriel":"'.$compte->getCourriel().'",'.
                '"motPasse":"'.$compte->getMotPasse().'"'.
            ' }';

        echo $compteJSON;
        //echo"Ajout r&acute;ussie !";
    }

}
