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
 * Description of ObtenirCompte
 *
 * @author Joel
 */
class ObtenirCompte implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "{}";
        if(isset($this->request['id']) || isset($this->request['courriel'])){
            $connexion = Connexion::getInstance();
            $compteDao = new CompteDAO();
            $compteDao->setCnx($connexion);

            if(isset($this->request['id'])){
                $compte = $compteDao->find($this->request['id']);
            }
            elseif(isset($this->request['courriel'])) {
                $compte = $compteDao->findByCourriel($this->request['courriel']);
            }

            if($compte != null){
                $resultatJSON = $compte->toJson();
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Un compte n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de trouver ce compte"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
