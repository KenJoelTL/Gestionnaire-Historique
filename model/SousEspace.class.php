<?php

namespace model;

/**
 * Description of SousEspace
 *
 * @author Joel
 */
class SousEspace {
    private $id;
    private $titre;
    private $idEspace;

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getIdEspace() {
        return $this->idEspace;
    }

    public function setId($idSousEspace) {
        $this->id = $idSousEspace;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setIdEspace($idEspace) {
        $this->idEspace = $idEspace;
    }

    public function loadFromArray($ligne){
        $this->setId($ligne['ID']);
        $this->setTitre($ligne['TITRE']);
        $this->setIdEspace($ligne['ID_ESPACE']);
    }

    public function loadFromObject($x){
        $this->id = $x->ID;
        $this->titre = $x->TITRE;
        $this->idEspace = $x->ID_ESPACE;
    }

    public function loadFromJsonObject($x){
        if(isset($x->id)){
            $this->setId($x->id);
        }
        if(isset($x->titre)){
            $this->setTitre($x->titre);
        }
        if(isset($x->idEspace)){
            $this->setIdEspace($x->idEspace);
        }
    }

    public function toJson(){
        $sousEspaceJSON =
            '{ '.
                '"id": '.$this->getId().' ,'.
                '"titre":"'.$this->getTitre().'",'.
                '"idEspace": '.$this->getIdEspace().''.
            ' }';

        return $sousEspaceJSON;
    }

}
