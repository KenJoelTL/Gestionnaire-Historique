<?php

namespace action;/*
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);*/
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/CompteDAO.class.php');
require_once('/model/Compte.class.php');
use model\dao\Connexion;
use model\dao\CompteDAO;
use model\Compte;
/**
 * Description of SupprimerCompte
 * service qui permet de supprimer un compte
 * @author Joel
 */
class SupprimerCompte implements Action, RequestAware {

    private $request;

    public function execute() {

        $connexion = Connexion::getInstance();
        $compteDao = new CompteDAO();
        $compteDao->setCnx($connexion);
        $compte = $compteDao->find($this->request->id);
        if($compte != null){
            $resultatJSON = '{"succes" : "Succès !"}';
            $compteDao->delete($compte->getId());
        }
        else { //attribut error sera créer dans la réponse (l'objet response)
            $resultatJSON = '{"error" : "Erreur : Le compte n\'existe pas"}';
        }
        Connexion::close();

        echo $resultatJSON;
    }

    public function setRequest($request){
        $this->request = $request;
    }

}
