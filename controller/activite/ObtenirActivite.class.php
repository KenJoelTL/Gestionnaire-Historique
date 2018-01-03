<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/ActiviteDAO.class.php');
require_once('/model/Activite.class.php');

use model\Activite;
use model\dao\Connexion;
use model\dao\ActiviteDAO;
/**
 * Description of ObtenirActivite
 *
 * @author Joel
 */
class ObtenirActivite implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "{}";
        if(isset($this->request['id'])){
            $connexion = Connexion::getInstance();
            $activiteDao = new ActiviteDAO();
            $activiteDao->setCnx($connexion);

            if(isset($this->request['id'])){
                $activite = $activiteDao->find($this->request['id']);
            }

            if($activite != null){
                $resultatJSON = $activite->toJson();
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Cette activité n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de trouver cette activité"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
