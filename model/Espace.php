<?php

namespace model;

/**
 * Description of Espace
 *
 * @author Joel
 */
class Espace {
    private $idEspace;
    private $titre;
    private $idCompte;
    
    function getIdEspace() {
        return $this->idEspace;
    }

    function getTitre() {
        return $this->titre;
    }

    function getIdCompte() {
        return $this->idCompte;
    }

    function setIdEspace($idEspace) {
        $this->idEspace = $idEspace;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;
    }


}
