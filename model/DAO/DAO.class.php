<?php

namespace model\dao;
include_once('/model/DAO/Connexion.class.php');

/**
 * Description of DAO
 *
 * @author Joel
 */
abstract class DAO {
    //put your code here
    protected $cnx;
    
    abstract public function create($object);
    abstract public function find($id);
    abstract public function findAll();
    abstract public function update($object);
    abstract public function delete($id);
    
    public function setCnx($cnx) {
        $this->cnx = $cnx;
    }
    
}
