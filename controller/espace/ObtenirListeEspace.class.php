<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/Espace.class.php');
require_once('/model/Liste.class.php');
use model\dao\Connexion;
use model\dao\EspaceDAO;
use model\Espace;
use model\Liste;
/**
 * Description of ObtenirListeEspace
 * service qui permet d'obtenir la liste de tous les espaces
 * @author Joel
 */
class ObtenirListeEspace implements Action {

    public function execute() {

        $connexion = Connexion::getInstance();
        $espaceDao = new EspaceDAO();
        $espaceDao->setCnx($connexion);
        $liste = $espaceDao->findAll();
        Connexion::close();

        $espaceJSON ='[';
        while($liste->next()){
            $espaceJSON .= $liste->current()->toJson();
            if($liste->hasNext()){
                $espaceJSON.= ',';
            }
        }

        echo $espaceJSON.=']';
    }

}
