<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/SousEspace.class.php');
require_once('/model/Liste.class.php');
use model\dao\Connexion;
use model\dao\SousEspaceDAO;
use model\SousEspace;
use model\Liste;
/**
 * Description of ObtenirListeSousEspace
 * service qui permet d'obtenir la liste de tous les sous-espaces
 * @author Joel
 */
class ObtenirListeSousEspace implements Action {

    public function execute() {

        $connexion = Connexion::getInstance();
        $sousEspaceDao = new SousEspaceDAO();
        $sousEspaceDao->setCnx($connexion);
        $liste = $sousEspaceDao->findAll();
        Connexion::close();

        $sousEspaceJSON ='[';
        while($liste->next()){
            $sousEspaceJSON .= $liste->current()->toJson();
            if($liste->hasNext()){
                $sousEspaceJSON.= ',';
            }
        }

        echo $sousEspaceJSON.=']';
    }

}
