<?php
namespace model;

class Compte {
    private $id;
    private $courriel;
    private $motPasse;

    public function getId() {
        return $this->id;
    }

    public function getCourriel() {
        return $this->courriel;
    }

    public function getMotPasse() {
        return $this->motPasse;
    }

    public function setId($idCompte) {
        $this->id = $idCompte;
    }

    public function setCourriel($courriel) {
        $this->courriel = $courriel;
    }

    public function setMotPasse($motPasse) {
        $this->motPasse = $motPasse;
    }

    public function __get($name) {
        switch ($name){
            case 'id':
                return $this->getId();
            case 'courriel':
                return $this->getCourriel();
            case 'motPasse':
                return $this->getMotPasse();
            default :
                return 'none';
        }
    }

    public function __set($name, $value) {
        switch ($name){
            case 'id':
                $this->setId($value);
            case 'courriel':
                $this->setCourriel($value);
            case 'motPasse':
                $this->setMotPasse($value);
            default :
                return 'none';
        }
    }

    public function loadFromArray($ligne){
        $this->setId($ligne['ID']);
        $this->setCourriel($ligne['COURRIEL']);
    //    $this->setNom($ligne['NOM']);
    //    $this->setPrenom($ligne['PRENOM']);
        $this->setMotPasse($ligne['MOT_PASSE']);
    }


    public function loadFromObject($x){
        $this->id = $x->ID;
        $this->courriel = $x->COURRIEL;
//        $this->nom = $x->NOM;
  //      $this->prenom = $x->PRENOM;
        $this->motPasse = $x->MOT_PASSE;
    }

    public function loadFromJsonObject($x){
        if(isset($x->id)){
            $this->setId($x->id);
        }
        if(isset($x->courriel)){
            $this->setCourriel($x->courriel);
        }
        if(isset($x->motPasse)){
            $this->setMotPasse($x->motPasse);
        }
//        $this->nom = $x->NOM;
  //      $this->prenom = $x->PRENOM;
    }

    public function toJson(){
        $compteJSON =
            '{ '.
                '"id":"'.$this->getId().'",'.
                '"courriel":"'.$this->getCourriel().'",'.
                '"motPasse":"'.$this->getMotPasse().'"'.
            ' }';

        return $compteJSON;
    }



}
