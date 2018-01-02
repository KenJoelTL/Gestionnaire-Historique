<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/SousEspace.class.php');

use model\SousEspace;
use model\dao\Connexion;
use model\dao\SousEspaceDAO;
/**
 * Description of ObtenirSousEspace
 *
 * @author Joel
 */
class ObtenirSousEspace implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "{}";
        if(isset($this->request['id'])){
            $connexion = Connexion::getInstance();
            $sousEspaceDao = new SousEspaceDAO();
            $sousEspaceDao->setCnx($connexion);

            if(isset($this->request['id'])){
                $sousEspace = $sousEspaceDao->find($this->request['id']);
            }

            if($sousEspace != null){
                $resultatJSON = $sousEspace->toJson();
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Ce sous-espace n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de trouver cet espace"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
