<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/Espace.class.php');

use model\Espace;
use model\dao\Connexion;
use model\dao\EspaceDAO;
/**
 * Description of ObtenirEspace
 *
 * @author Joel
 */
class ObtenirEspace implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "{}";
        if(isset($this->request['id'])){
            $connexion = Connexion::getInstance();
            $espaceDao = new EspaceDAO();
            $espaceDao->setCnx($connexion);

            if(isset($this->request['id'])){
                $espace = $espaceDao->find($this->request['id']);
            }

            if($espace != null){
                $resultatJSON = $espace->toJson();
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Cet espace n\'existe pas"}';
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
