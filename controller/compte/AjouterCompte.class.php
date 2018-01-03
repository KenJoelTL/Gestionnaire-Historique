<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/CompteDAO.class.php');
require_once('/model/Compte.class.php');

use model\Compte;
use model\dao\Connexion;
use model\dao\CompteDAO;
/**
 * Description of AjouterCompte
 *
 * @author Joel
 */
class AjouterCompte implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->compte)){
            $connexion = Connexion::getInstance();
            $compteDao = new CompteDAO();
            $compteDao->setCnx($connexion);

            $compte = new Compte();
            $compte->loadFromJsonObject($this->request->compte);
            $compteVerification = $compteDao->findByCourriel($compte->getCourriel());

            if($compteVerification == null){
                $resultatJSON = '{"success" : "Ajout réussie !"}';
                $compteDao->create($compte);
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Un compte avec ce courriel existe déjà"}';
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
