<!DOCTYPE html>
<?php 
require_once('./model/DAO/Connexion.class.php');
include_once('/model/DAO/CompteDAO.class.php'); 
include_once('/model/Compte.class.php'); 
include_once('/model/Liste.class.php');

use model\dao\Connexion;
use model\dao\CompteDAO;
use model\Liste;
use model\Compte;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $cnx = Connexion::getInstance();
        $compteDao = new CompteDAO();
        $compteDao->setCnx($cnx);
        
        $liste = $compteDao->findAll();
        
        echo "Affichage des comptes :<br/>";

        while($liste->next()){
            echo $liste->current()->getCourriel()."<br/>";
        }

        echo"<br/>";

        echo "Création du compte joel@mail.com :<br/>";
        $compte = new Compte();
        $compte->setCourriel('joel@mail.com');
        $compte->setMotPasse('joel');
        $compteDao->create($compte);
        echo"<br/>";

        echo"Réinitialisation de la liste...<br/>";
        $liste = $compteDao->findAll();
        echo"<br/>";

        echo"Affichage des comptes :<br/>";

        $liste = $compteDao->findAll();
        while($liste->next()){
            echo $liste->current()->getCourriel()."<br/>";
        }

        echo"<br/>";
        
        
        echo "Affichage du compte 1 :<br/>";
        $compte = $compteDao->find(1);
        echo $compte->getCourriel()."<br/>";
   
        echo "<br/>";

        echo "Affichage du compte joel@mail.com :<br/>";
        $compte = $compteDao->findByCourriel('joel@mail.com');
        if ($compte != null) {
            echo $compte->getCourriel() . "<br/>";
        } else {
            echo "Le compte n'existe pas<br/>";
        }

        echo "<br/>";
        
        echo "Modification du compte joel@mail.com par eric@mail.com :<br/>";
        $compte->setCourriel('eric@mail.com');
        $compteDao->update($compte);
        echo"<br/>";

        echo"Réinitialisation de la liste...<br/>";
        $liste = $compteDao->findAll();
        echo"<br/>";

        echo"Affichage des comptes :<br/>";

        while($liste->next()){
            echo $liste->current()->getCourriel()."<br/>";
        }

        echo"<br/>";
        
        
        echo "Suppression du compte eric@mail.com :<br/>";
        echo "Suppression ".(($compteDao->delete($compte->getId()))? "Réussie" : "Échouée");
        echo "<br/>";
   
        echo "<br/>";        

        echo "Réinitialisation de la liste...<br/>";
        $liste->reset();
        $liste = $compteDao->findAll();

        echo"<br/>";        
        
        
        echo "Affichage des comptes :<br/>";
        while($liste->next()){
            echo $liste->current()->getCourriel()."<br/>";
        }
        
        Connexion::close();
        ?>
    </body>
</html>
