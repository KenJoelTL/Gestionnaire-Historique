<?php
namespace model;

class Compte {
    private $idCompte;
    private $pseudo;
    private $motPasse;

    public function __get($name) {
        switch ($name){
            case 'id':
                return $this->idCompte;
            case 'pseudo':
                return $this->pseudo;
            case 'motPasse':
                return $this->motPasse;
            default :
                return 'none';     
        }
    }
    
    public function __set($name, $value) {
        switch ($name){
            case 'id':
                $this->idCompte = $value;
            case 'pseudo':
                $this->pseudo = $value;
            case 'motPasse':
                $this->motPasse = $value;
        }
    }
    
}
