<?php

namespace model\dao;
include_once('/model/DAO/DAO.class.php');
use model\Liste;
use model\SousEspace;
use \PDO;
use model\dao\Connexion;

/**
 * Description of SousEspaceDAO
 *
 * @author Joel
 */
class SousEspaceDAO extends DAO {

    public function create($sousEspace) {
        try{
            $request = "INSERT INTO sous_espace (TITRE, ID_ESPACE) values (:titre, :idEspace)";
            $pstmt = $this->cnx->prepare($request);

            $titre = $sousEspace->getTitre();
            $idEspace = $sousEspace->getIdEspace();

            $pstmt->bindParam(":titre", $titre);
            $pstmt->bindParam(":idEspace", $idEspace);

            return $pstmt->execute();
        }
        catch(PDOException $e){
            throw $e;
        }

    }

    public function update($sousEspace) {
        try{
            $request = "UPDATE sous_espace SET TITRE = :titre, ID_ESPACE = :idEspace WHERE ID = :id";

            $pstmt = $this->cnx->prepare($request);

            $titre = $sousEspace->getTitre();
            $idEspace = $sousEspace->getIdEspace();
            $id = $sousEspace->getId();

            $pstmt->bindParam(':titre', $titre);
            $pstmt->bindParam(':idEspace', $idEspace);
            $pstmt->bindParam(':id', $id);

            return $pstmt->execute();
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function delete($id) {
        $request = "DELETE FROM sous_espace WHERE ID = :x";
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
        $request = "SELECT * FROM sous_espace WHERE ID = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
        $pstmt->execute(array(':x' => $id));

        $sousEspace = null;
        $resultat = $pstmt->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            $sousEspace = new SousEspace();
            $sousEspace->loadFromObject($resultat);
        }
        $pstmt->closeCursor();
        return $sousEspace;
    }

    public function findAll() {
        $liste = new Liste();
        $requete = 'SELECT * FROM sous_espace';
        try {
            $resultat = $this->cnx->query($requete);
            foreach($resultat as $ligne) {
                $sousEspace = new SousEspace();
                $sousEspace->loadFromArray($ligne);
                $liste->add($sousEspace);
            }
            $resultat->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;
    }

    //Fonction qui retourne la liste des espaces d'un utilisateur à l'aide de son $idEspace
    public function findByIdEspace($idEspace) {

        $liste = new Liste();
        $request = "SELECT * FROM sous_espace WHERE ID_ESPACE = :x";
        try {
            $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
            $pstmt->execute(array(':x' => $idEspace));

            while ($resultat = $pstmt->fetch(PDO::FETCH_OBJ)){
                $sousEspace = new SousEspace();
				$sousEspace->loadFromObject($resultat);
                $liste->add($sousEspace);
		    }
/*
            foreach($pstmt as $ligne) {
                $sousEspace = new SousEspace();
                $sousEspace->loadFromArray($ligne);
                $liste->add($sousEspace);
            }*/

            //$resultat->closeCursor();
            $pstmt->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;

    }

    /*
    public function findByCourriel($courriel) {
        $request = "SELECT * FROM sous_espace WHERE COURRIEL = :x";
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
