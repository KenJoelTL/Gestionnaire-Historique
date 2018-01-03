<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/ActiviteDAO.class.php');
require_once('/model/Activite.class.php');
use model\dao\Connexion;
use model\dao\ActiviteDAO;
use model\Activite;
/**
 * Description of SupprimerActivite
 * service qui permet de supprimer une activité
 * @author Joel
 */
class SupprimerActivite implements Action, RequestAware {

    private $request;

    public function execute() {

        $connexion = Connexion::getInstance();
        $activiteDao = new ActiviteDAO();
        $activiteDao->setCnx($connexion);
        $activite = $activiteDao->find($this->request->id);
        if($activite != null){
            $resultatJSON = '{"success" : "Succès !"}';
            $activiteDao->delete($activite->getId());
        }
        else { //attribut error sera créer dans la réponse (l'objet response)
            $resultatJSON = '{"error" : "Erreur : L\'activité n\'existe pas"}';
        }
        Connexion::close();

        echo $resultatJSON;
    }

    public function setRequest($request){
        $this->request = $request;
    }

}
