<?php

namespace model;

/**
 * Description of Espace
 *
 * @author Joel
 */
class Espace {
    private $id;
    private $titre;
    private $idCompte;

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getIdCompte() {
        return $this->idCompte;
    }

    public function setId($idEspace) {
        $this->id = $idEspace;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;
    }

    public function loadFromArray($ligne){
        $this->setId($ligne['ID']);
        $this->setTitre($ligne['TITRE']);
        $this->setIdCompte($ligne['ID_COMPTE']);
    }

    public function loadFromObject($x){
        $this->id = $x->ID;
        $this->titre = $x->TITRE;
        $this->idCompte = $x->ID_COMPTE;
    }

    public function loadFromJsonObject($x){
        if(isset($x->id)){
            $this->setId($x->id);
        }
        if(isset($x->titre)){
            $this->setTitre($x->titre);
        }
        if(isset($x->idCompte)){
            $this->setIdCompte($x->idCompte);
        }
    }

    public function toJson(){
        $compteJSON =
            '{ '.
                '"id": '.$this->getId().' ,'.
                '"titre":"'.$this->getTitre().'",'.
                '"idCompte": '.$this->getIdCompte().''.
            ' }';

        return $compteJSON;
    }

}
