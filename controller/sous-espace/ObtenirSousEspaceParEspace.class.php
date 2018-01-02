<?php

namespace action;
require_once('/controller/Action.interface.php');
require_once('/controller/RequestAware.interface.php');
require_once('/model/DAO/Connexion.class.php');
require_once('/model/DAO/EspaceDAO.class.php');
require_once('/model/DAO/SousEspaceDAO.class.php');
require_once('/model/Espace.class.php');
require_once('/model/SousEspace.class.php');

use model\Espace;
use model\SousEspace;
use model\dao\Connexion;
use model\dao\EspaceDAO;
use model\dao\SousEspaceDAO;
/**
 * Description of ObtenirSousEspaceParEspace
 *
 * @author Joel
 */
class ObtenirSousEspaceParEspace implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "[]";
        if(isset($this->request['id'])){
            $connexion = Connexion::getInstance();
            $sousEspaceDao = new SousEspaceDAO();
            $espaceDao = new EspaceDAO();
            $sousEspaceDao->setCnx($connexion);
            $espaceDao->setCnx($connexion);

            if(isset($this->request['id'])){
                $espace = $espaceDao->find($this->request['id']);
            }

            if($espace != null){
                $liste = $sousEspaceDao->findByIdEspace($espace->getId());
                $resultatJSON ='[';
                while($liste->next()){
                    $resultatJSON .= $liste->current()->toJson();
                    if($liste->hasNext()){
                        $resultatJSON.= ',';
                    }
                }

                $resultatJSON.=']';

            }
            else { //attribut error sera créer dans la réponse (l'objet response)
                $resultatJSON = '{"error" : "Erreur : Ce sous-espace n\'existe pas"}';
            }

            Connexion::close();

        }
        else {
            $resultatJSON = '{"error" : "Erreur : Impossible de trouver cet espace"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
