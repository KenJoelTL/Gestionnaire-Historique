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
 * Description of ModifierCompte
 *
 * @author Joel
 */
class ModifierCompte implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->id) && isset($this->request->compte)){
            $connexion = Connexion::getInstance();
            $compteDao = new CompteDAO();
            $compteDao->setCnx($connexion);

            $compte = new Compte();
            $compte->loadFromJsonObject($this->request->compte);
            $compteVerification = $compteDao->find($this->request->id);

            if($compteVerification != null){
                if($compteVerification->getCourriel() != $compte->getCourriel()){
                    $compteVerification = $compteDao->findByCourriel($compte->getCourriel());
                    if($compteVerification != null){
                        $resultatJSON = '{"error" : "Erreur : Un compte avec ce courriel existe déjà"}';
                    }else{
                        $compteDao->update($compte);
                        $resultatJSON = '{"succes" : "Modification réussie !"}';
                    }
                }
                else{
                    $compteDao->update($compte);
                    $resultatJSON = '{"succes" : "Modification réussie !"}';
                }
            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Ce compte n\'existe pas"}';
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
