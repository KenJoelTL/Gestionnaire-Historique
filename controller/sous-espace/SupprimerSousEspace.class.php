<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/SousEspace.class.php');
use model\dao\Connexion;
use model\dao\SousEspaceDAO;
use model\SousEspace;
/**
 * Description of SupprimerSousEspace
 * service qui permet de supprimer un sous-espace
 * @author Joel
 */
class SupprimerSousEspace implements Action, RequestAware {

    private $request;

    public function execute() {

        $connexion = Connexion::getInstance();
        $sousEspaceDao = new SousEspaceDAO();
        $sousEspaceDao->setCnx($connexion);
        $sousEspace = $sousEspaceDao->find($this->request->id);
        if($sousEspace != null){
            $resultatJSON = '{"success" : "Succès !"}';
            $sousEspaceDao->delete($sousEspace->getId());
        }
        else { //attribut error sera créer dans la réponse (l'objet response)
            $resultatJSON = '{"error" : "Erreur : Le sous-espace n\'existe pas"}';
        }
        Connexion::close();

        echo $resultatJSON;
    }

    public function setRequest($request){
        $this->request = $request;
    }

}
