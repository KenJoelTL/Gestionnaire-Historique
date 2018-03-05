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
 * Description of ConnecterCompte
 *
 * @author Joel
 */
class ConnecterCompte implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "{}";
        if(isset($this->request->compte->courriel) && isset($this->request->compte->motPasse)){
            $connexion = Connexion::getInstance();
            $compteDao = new CompteDAO();
            $compteDao->setCnx($connexion);

            $compte = $compteDao->findByCourriel($this->request->compte->courriel);

            if($compte != null){

                if($compte->getMotPasse() === $this->request->compte->motPasse){
                    session_start();
                    $_SESSION['connecte'] = $compte->getId();
                    //$resultatJSON = $compte->toJson();
                    $resultatJSON = '{"Resutat" : "Succès" }';
                }
                else{
                    $resultatJSON = '{"error" : "Erreur : ce compte n\'existe pas"}';
                }

            }
            else { //attribut error sera créé dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : ce compte n\'existe pas"}';
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
