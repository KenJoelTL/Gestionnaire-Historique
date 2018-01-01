<?php

namespace model\dao;
include_once('/model/DAO/DAO.class.php');
use model\Liste;
use model\Espace;
use \PDO;
use model\dao\Connexion;

/**
 * Description of EspaceDAO
 *
 * @author Joel
 */
class EspaceDAO extends DAO {

    public function create($espace) {
        try{
            $request = "INSERT INTO espace (TITRE, ID_COMPTE) values (:titre, :idCompte)";
            $pstmt = $this->cnx->prepare($request);

            $titre = $espace->getTitre();
            $idCompte = $espace->getIdCompte();

            $pstmt->bindParam(":titre", $titre);
            $pstmt->bindParam(":idCompte", $idCompte);

            return $pstmt->execute();
        }
        catch(PDOException $e){
            throw $e;
        }

    }

    public function update($espace) {
        try{
            $request = "UPDATE espace SET TITRE = :titre, ID_COMPTE = :idCompte WHERE ID = :id";

            $pstmt = $this->cnx->prepare($request);

            $titre = $espace->getTitre();
            $idCompte = $espace->getIdCompte();
            $id = $espace->getId();

            $pstmt->bindParam(':titre', $titre);
            $pstmt->bindParam(':idCompte', $idCompte);
            $pstmt->bindParam(':id', $id);

            return $pstmt->execute();
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function delete($id) {
        $request = "DELETE FROM espace WHERE ID = :x";
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
        $request = "SELECT * FROM espace WHERE ID = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
        $pstmt->execute(array(':x' => $id));

        $espace = null;
        $resultat = $pstmt->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            $espace = new Espace();
            $espace->loadFromObject($resultat);
        }
        $pstmt->closeCursor();
        return $espace;
    }

    public function findAll() {
        $liste = new Liste();
        $requete = 'SELECT * FROM espace';
        try {
            $resultat = $this->cnx->query($requete);
            foreach($resultat as $ligne) {
                $espace = new Espace();
                $espace->loadFromArray($ligne);
                $liste->add($espace);
            }
            $resultat->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;
    }

    //Fonction qui retourne la liste des espaces d'un utilisateur à l'aide de son $idCompte
    public function findByIdCompte($idCompte) {

        $liste = new Liste();
        $request = "SELECT * FROM espace WHERE ID_COMPTE = :x";
        try {
            $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
            $pstmt->execute(array(':x' => $idCompte));

            while ($resultat = $pstmt->fetch(PDO::FETCH_OBJ)){
                $espace = new Espace();
				$espace->loadFromObject($resultat);
                $liste->add($espace);
		    }
            $resultat->closeCursor();
            //$pstmt->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;

    }

    /*
    public function findByCourriel($courriel) {
        $request = "SELECT * FROM espace WHERE COURRIEL = :x";
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
*/


}
