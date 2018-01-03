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
use model\dao\SousEspaceDAO;
use model\dao\ActiviteDAO;
/**
 * Description of AjouterActivite
 *
 * @author Joel
 */
class AjouterActivite implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->activite)){
            $connexion = Connexion::getInstance();
            $activiteDao = new ActiviteDAO();
            $sousEspaceDao = new SousEspaceDAO();
            $activiteDao->setCnx($connexion);
            $sousEspaceDao->setCnx($connexion);

            $activite = new Activite();
            $activite->loadFromJsonObject($this->request->activite);
            $activiteVerification = $activiteDao->find($activite->getId());

            if($activiteVerification == null){
                $sousEspaceVerification = $sousEspaceDao->find($activite->getIdSousEspace());
                if($sousEspaceVerification != null) {
                    $resultatJSON = '{"success" : "Ajout réussie !"}';
                    $activiteDao->create($activite);
                }
                else{
                    $resultatJSON = '{"error" : "Erreur : Ce sous-espace de travail n\'existe pas"}';
                }
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Cette activité n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de modifier une activité"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
