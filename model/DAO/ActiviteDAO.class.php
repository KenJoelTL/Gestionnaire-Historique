<?php

namespace model\dao;
include_once('/model/DAO/DAO.class.php');
use model\Liste;
use model\Activite;
use \PDO;
use model\dao\Connexion;

/**
 * Description of ActiviteDAO
 *
 * @author Joel
 */
class ActiviteDAO extends DAO {

    public function create($activite) {
        try{
            $request = "INSERT INTO activite (TITRE, URL, ID_SOUS_ESPACE) values (:titre, :url, :idSousEspace)";
            $pstmt = $this->cnx->prepare($request);

            $titre = $activite->getTitre();
            $url = $activite->getUrl();
            $idSousEspace = $activite->getIdSousEspace();

            $pstmt->bindParam(":titre", $titre);
            $pstmt->bindParam(":url", $url);
            $pstmt->bindParam(":idSousEspace", $idSousEspace);

            return $pstmt->execute();
        }
        catch(PDOException $e){
            throw $e;
        }

    }

    public function update($activite) {
        try{
            $request = "UPDATE activite SET TITRE = :titre, URL = :url, ID_SOUS_ESPACE = :idSousEspace WHERE ID = :id";

            $pstmt = $this->cnx->prepare($request);

            $titre = $activite->getTitre();
            $url = $activite->getUrl();
            $idSousEspace = $activite->getIdSousEspace();
            $id = $activite->getId();

            $pstmt->bindParam(':titre', $titre);
            $pstmt->bindParam(':url', $url);
            $pstmt->bindParam(':idSousEspace', $idSousEspace);
            $pstmt->bindParam(':id', $id);

            return $pstmt->execute();
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function delete($id) {
        $request = "DELETE FROM activite WHERE ID = :x";
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
        $request = "SELECT * FROM activite WHERE ID = :x";
        $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
        $pstmt->execute(array(':x' => $id));

        $activite = null;
        $resultat = $pstmt->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            $activite = new Activite();
            $activite->loadFromObject($resultat);
        }
        $pstmt->closeCursor();
        return $activite;
    }

    public function findAll() {
        $liste = new Liste();
        $requete = 'SELECT * FROM activite';
        try {
            $resultat = $this->cnx->query($requete);
            foreach($resultat as $ligne) {
                $activite = new Activite();
                $activite->loadFromArray($ligne);
                $liste->add($activite);
            }
            $resultat->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;
    }

    //Fonction qui retourne la liste des activite d'un utilisateur à l'aide de son $idSousEspace
    public function findByIdSousEspace($idSousEspace) {
        $liste = new Liste();
        $request = "SELECT * FROM activite WHERE ID_SOUS_ESPACE = :x";
        try {
            $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
            $pstmt->execute(array(':x' => $idSousEspace));

            while ($resultat = $pstmt->fetch(PDO::FETCH_OBJ)){
                $activite = new Activite();
                $activite->loadFromObject($resultat);
                $liste->add($activite);
            }

            $pstmt->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;

    }

    /*
    public function findByCourriel($courriel) {
        $request = "SELECT * FROM activite WHERE COURRIEL = :x";
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
    public function findByIdEspace($idEspace) {
        $liste = new Liste();
        $request = "SELECT * FROM activite WHERE ID_SOUS_ESPACE in ".
                "(". "SELECT * FROM sous_espace WHERE ID_ESPACE = :x". ")";
        try {
            $pstmt = $this->cnx->prepare($request);//requête paramétrée par un paramètre x.
            $pstmt->execute(array(':x' => $idEspace));

            while ($resultat = $pstmt->fetch(PDO::FETCH_OBJ)){
                $activite = new Activite();
                $activite->loadFromObject($resultat);
                $liste->add($activite);
            }

            $pstmt->closeCursor();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return $liste;

    }

}
