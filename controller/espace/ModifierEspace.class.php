<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/DAO/CompteDAO.class.php');
require_once('/model/Espace.class.php');
require_once('/model/Compte.class.php');

use model\Espace;
use model\Compte;
use model\dao\Connexion;
use model\dao\EspaceDAO;
use model\dao\CompteDAO;
/**
 * Description of ModifierEspace
 *
 * @author Joel
 */
class ModifierEspace implements Action , RequestAware {

    private $request;

    public function execute() {

        if(isset($this->request->id) && isset($this->request->espace)){
            $connexion = Connexion::getInstance();
            $espaceDao = new EspaceDAO();
            $compteDao = new CompteDAO();
            $espaceDao->setCnx($connexion);
            $compteDao->setCnx($connexion);

            $espace = new Espace();
            $espace->loadFromJsonObject($this->request->espace);
            $espaceOriginal = $espaceDao->find($this->request->id);

            if($espaceOriginal != null){
                if($espaceOriginal->getIdCompte() != $espace->getIdCompte()){
                    $compteNouveau = $compteDao->find($espace->getIdCompte());
                    if($compteNouveau == null){
                        $resultatJSON = '{"error" : "Erreur : Un compte n\'existe pas"}';
                    }else{
                        $espaceDao->update($espace);
                        $resultatJSON = '{"success" : "Modification réussie !"}';
                    }
                }
                else{
                    $espaceDao->update($espace);
                    $resultatJSON = '{"success" : "Modification réussie !"}';
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
