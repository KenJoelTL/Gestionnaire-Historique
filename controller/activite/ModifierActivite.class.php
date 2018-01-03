<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/ActiviteDAO.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/Activite.class.php');
require_once('/model/SousEspace.class.php');

use model\Activite;
use model\SousEspace;
use model\dao\Connexion;
use model\dao\ActiviteDAO;
use model\dao\SousEspaceDAO;
/**
 * Description of ModifierActivite
 *
 * @author Joel
 */
class ModifierActivite implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->id) && isset($this->request->activite)){
            $connexion = Connexion::getInstance();
            $activiteDao = new ActiviteDAO();
            $sousEspaceDao = new SousEspaceDAO();
            $activiteDao->setCnx($connexion);
            $sousEspaceDao->setCnx($connexion);

            $activite = new Activite();
            $activite->loadFromJsonObject($this->request->activite);
            $activiteOriginal = $activiteDao->find($this->request->id);

            if($activiteOriginal != null){
                if($activiteOriginal->getIdSousEspace() != $activite->getIdSousEspace()){
                    $sousEspaceNouveau = $sousEspaceDao->find($activite->getIdSousEspace());
                    if($sousEspaceNouveau == null){
                        $resultatJSON = '{"error" : "Erreur : Ce sous-espace n\'existe pas"}';
                    }else{
                        $activiteDao->update($activite);
                        $resultatJSON = '{"success" : "Modification réussie !"}';
                    }
                }
                else{
                    $activiteDao->update($activite);
                    $resultatJSON = '{"success" : "Modification réussie !"}';
                }
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Cette activité n\'existe pas"}';
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
