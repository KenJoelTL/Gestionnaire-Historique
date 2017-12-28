<?php

namespace model\dao;
include_once('/model/DAO/DAO.class.php');
use model\Liste;
use model\Compte;
use \PDO;
use model\dao\Connexion;

/**
 * Description of CompteDAO
 *
 * @author Joel
 */
class CompteDAO extends DAO{
   
    public function create($compte) {
        try{
            $request = "INSERT INTO compte (COURRIEL, MOT_PASSE) values (:courriel, :motPasse)";
            $pstmt = $this->cnx->prepare($request);
            
            $courriel = $compte->getCourriel();
            $motPasse = $compte->getMotPasse();
            
            $pstmt->bindParam(":courriel", $courriel);
            $pstmt->bindParam(":motPasse", $motPasse);
            
            return $pstmt->execute();            
        }
        catch(PDOException $e){
            throw $e;
        }

    }

    public function update($compte) {
        try{
            $request = "UPDATE compte SET COURRIEL = :courriel, MOT_PASSE = :motPasse WHERE ID = :id";
            
            $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
            
            $courriel = $compte->getCourriel();
            $motPasse = $compte->getMotPasse();
            $id = $compte->getId();    
                        
            $pstmt->bindParam(':courriel', $courriel);
            $pstmt->bindParam(':motPasse', $motPasse);
            $pstmt->bindParam(':id', $id);
            //$pstmt->execute(array(':courriel' => $id,':motPasse' => $id,':id' => $id));

            
            return $pstmt->execute();
        }
        catch(PDOException $e){
            throw $e;
        }
    }

    public function delete($id) {
        $request = "DELETE FROM compte WHERE ID = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
    //    $pstmt->execute(array(':x' => $id));
        $pstmt->bindParam(":x", $id);
        try{
            return $pstmt->execute();
        }
        catch(PDOException $e){
            throw $e;
        }
    }

    public function find($id) {
        $request = "SELECT * FROM compte WHERE ID = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
        $pstmt->execute(array(':x' => $id));

        $c = null;
        $resultat = $pstmt->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            $c = new Compte();
            $c->loadFromObject($resultat);
        }
        $pstmt->closeCursor();
        return $c;
    }

    public function findAll() {
        $liste = new Liste();
        $requete = 'SELECT * FROM compte';
        try {
            $resultat = $this->cnx->query($requete);
            foreach($resultat as $ligne) {
                $c = new Compte();
                $c->loadFromArray($ligne);
                $liste->add($c);
            }
            $resultat->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;
    }
    
    //Fonction qui retourne un utilisateur à l'aide de son courriel
    public function findByCourriel($courriel) {
        $request = "SELECT * FROM compte WHERE COURRIEL = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
        $pstmt->execute(array(':x' => $courriel));

        $c = null;
        $resultat = $pstmt->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            $c = new Compte();
            $c->loadFromObject($resultat);
        }
        $pstmt->closeCursor();
        return $c;
    }
    


}
