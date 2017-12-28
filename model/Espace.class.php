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

}
