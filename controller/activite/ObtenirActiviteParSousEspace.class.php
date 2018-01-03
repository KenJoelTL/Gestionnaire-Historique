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
use model\dao\ActiviteDAO;
use model\dao\SousEspaceDAO;
/**
 * Description of ObtenirActiviteParSousEspace
 *
 * @author Joel
 */
class ObtenirActiviteParSousEspace implements Action , RequestAware {

    private $request;

    public function execute() {
        $resultatJSON = "[]";
        if(isset($this->request['id'])){
            $connexion = Connexion::getInstance();
            $activiteDao = new ActiviteDAO();
            $sousEspaceDao = new SousEspaceDAO();
            $activiteDao->setCnx($connexion);
            $sousEspaceDao->setCnx($connexion);

            $sousEspace = $sousEspaceDao->find($this->request['id']);

            if($sousEspace != null){
                $liste = $activiteDao->findByIdSousEspace($sousEspace->getId());
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
            $resultatJSON = '{"error" : "Erreur : Impossible de trouver ce sous-espace", "sousEspace" : "[]"}';
        }

        echo $resultatJSON;

    }

    public function setRequest($request){
        $this->request = $request;
    }

}
