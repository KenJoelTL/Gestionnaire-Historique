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
 * Description of ModifierSousEspace
 *
 * @author Joel
 */
class ModifierSousEspace implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->id) && isset($this->request->sousEspace)){
            $connexion = Connexion::getInstance();
            $espaceDao = new EspaceDAO();
            $sousEspaceDao = new SousEspaceDAO();
            $espaceDao->setCnx($connexion);
            $sousEspaceDao->setCnx($connexion);

            $sousEspace = new SousEspace();
            $sousEspace->loadFromJsonObject($this->request->sousEspace);
            $sousEspaceOriginal = $sousEspaceDao->find($this->request->id);

            if($sousEspaceOriginal != null){
                if($sousEspaceOriginal->getIdEspace() != $sousEspace->getIdEspace()){
                    $espaceNouveau = $espaceDao->find($sousEspace->getIdEspace());
                    if($espaceNouveau == null){
                        $resultatJSON = '{"error" : "Erreur : Cet espace n\'existe pas"}';
                    }else{
                        $sousEspaceDao->update($sousEspace);
                        $resultatJSON = '{"succes" : "Modification réussie !"}';
                    }
                }
                else{
                    $sousEspaceDao->update($sousEspace);
                    $resultatJSON = '{"succes" : "Modification réussie !"}';
                }
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Ce sous-espace n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Modification impossible"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
