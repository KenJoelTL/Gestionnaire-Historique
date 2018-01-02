<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/Espace.class.php');
require_once('/model/SousEspace.class.php');

use model\Espace;
use model\SousEspace;
use model\dao\Connexion;
use model\dao\EspaceDAO;
use model\dao\SousEspaceDAO;
/**
 * Description of AjouterSousEspace
 *
 * @author Joel
 */
class AjouterSousEspace implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->sousEspace)){
            $connexion = Connexion::getInstance();
            $espaceDao = new EspaceDAO();
            $sousEspaceDao = new SousEspaceDAO();
            $espaceDao->setCnx($connexion);
            $sousEspaceDao->setCnx($connexion);

            $sousEspace = new SousEspace();
            $sousEspace->loadFromJsonObject($this->request->sousEspace);
            $espaceVerification = $espaceDao->find($sousEspace->getIdEspace());
            $sousEspaceVerification = $sousEspaceDao->find($sousEspace->getId());

            if($espaceVerification != null) {
                $resultatJSON = '{"succes" : "Ajout réussie !"}';
                $sousEspaceDao->create($sousEspace);
            }/*
            elseif($sousEspaceVerification == null){
                $resultatJSON = '{"error" : "Erreur : Ce sous-espace de travail existe pas déjà"}';
            }*/
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Cet espace de travail n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de créer un espace de travail"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
