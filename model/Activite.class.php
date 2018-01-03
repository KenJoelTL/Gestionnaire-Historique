<?php

namespace model;

/**
 * Description of Activite
 *
 * @author Joel
 */
class Activite {
    private $id;
    private $titre;
    private $idSousEspace;

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getIdSousEspace() {
        return $this->idSousEspace;
    }

    public function setId($idSousEspace) {
        $this->id = $idSousEspace;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setIdSousEspace($idSousEspace) {
        $this->idSousEspace = $idSousEspace;
    }

    public function loadFromArray($ligne){
        $this->setId($ligne['ID']);
        $this->setTitre($ligne['TITRE']);
        $this->setIdSousEspace($ligne['ID_SOUS_ESPACE']);
    }

    public function loadFromObject($x){
        $this->id = $x->ID;
        $this->titre = $x->TITRE;
        $this->idSousEspace = $x->ID_SOUS_ESPACE;
    }

    public function loadFromJsonObject($x){
        if(isset($x->id)){
            $this->setId($x->id);
        }
        if(isset($x->titre)){
            $this->setTitre($x->titre);
        }
        if(isset($x->idSousEspace)){
            $this->setIdSousEspace($x->idSousEspace);
        }
    }

    public function toJson(){
        $sousEspaceJSON =
            '{ '.
                '"id": '.$this->getId().' ,'.
                '"titre":"'.$this->getTitre().'",'.
                '"idSousEspace": '.$this->getIdSousEspace().''.
            ' }';

        return $sousEspaceJSON;
    }

}
