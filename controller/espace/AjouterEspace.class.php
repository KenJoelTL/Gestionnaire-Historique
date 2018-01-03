<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/CompteDAO.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/Compte.class.php');
require_once('/model/Espace.class.php');

use model\Compte;
use model\Espace;
use model\dao\Connexion;
use model\dao\CompteDAO;
use model\dao\EspaceDAO;
/**
 * Description of AjouterEspace
 *
 * @author Joel
 */
class AjouterEspace implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->espace)){
            $connexion = Connexion::getInstance();
            $compteDao = new CompteDAO();
            $espaceDao = new EspaceDAO();
            $compteDao->setCnx($connexion);
            $espaceDao->setCnx($connexion);

            $espace = new Espace();
            $espace->loadFromJsonObject($this->request->espace);
            $compteVerification = $compteDao->find($espace->getIdCompte());
            $espaceVerification = $espaceDao->find($espace->getId());

            if($compteVerification != null) {
                $resultatJSON = '{"success" : "Ajout réussie !"}';
                $espaceDao->create($espace);
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Ce compte n\'existe déjà"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de créer un compte"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
