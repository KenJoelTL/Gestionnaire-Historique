<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/Espace.class.php');
use model\dao\Connexion;
use model\dao\EspaceDAO;
use model\Espace;
/**
 * Description of supprimerEspace
 * service qui permet de supprimer un espace
 * @author Joel
 */
class SupprimerEspace implements Action, RequestAware {

    private $request;

    public function execute() {

        $connexion = Connexion::getInstance();
        $espaceDao = new EspaceDAO();
        $espaceDao->setCnx($connexion);
        $espace = $espaceDao->find($this->request->id);
        if($espace != null){
            $resultatJSON = '{"success" : "Succès !"}';
            $espaceDao->delete($espace->getId());
        }
        else { //attribut error sera créer dans la réponse (l'objet response)
            $resultatJSON = '{"error" : "Erreur : L\'espace n\'existe pas"}';
        }
        Connexion::close();

        echo $resultatJSON;
    }

    public function setRequest($request){
        $this->request = $request;
    }

}
