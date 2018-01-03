<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/ActiviteDAO.class.php');
require_once('/model/Activite.class.php');
require_once('/model/Liste.class.php');
use model\dao\Connexion;
use model\dao\ActiviteDAO;
use model\Activite;
use model\Liste;
/**
 * Description of ObtenirListeActivite
 * service qui permet d'obtenir la liste de toutes les activités
 * @author Joel
 */
class ObtenirListeActivite implements Action {

    public function execute() {

        $connexion = Connexion::getInstance();
        $activiteDao = new ActiviteDAO();
        $activiteDao->setCnx($connexion);
        $liste = $activiteDao->findAll();
        Connexion::close();

        $resultatJSON ='[';
        while($liste->next()){
            $resultatJSON .= $liste->current()->toJson();
            if($liste->hasNext()){
                $resultatJSON.= ',';
            }
        }

        echo $resultatJSON.=']';
    }

}
