<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['connecte'])){
  header('Location: ./index.php');
  exit();
}
require_once('./model/DAO/Connexion.class.php');
require_once('./model/DAO/ActiviteDAO.class.php');
require_once('./model/Activite.class.php');
require_once('./model/Liste.class.php');

use model\dao\Connexion;
use model\dao\ActiviteDAO;
use model\Activite;
use model\Liste;
?>

<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <title>Gestionnaire historique</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./lib/bootstrap-3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="./lib/bootstrap-3.3.7/css/bootstrap-theme.min.css">
    </head>
    <body>

        <div class="container" ng-controller="compteCtrl">
            <div class="panel panel-primary col-lg-6 col-lg-offset-3 ">
                <div class="panel panel-body">
                    <form class="form-account" method="POST" ng-submit="connexion()">
                        <h1>Page de connexion</h1>
                        <div class="form-group col-lg-12">
                            <label for="courriel">Courriel</label>
                            <input type="email" class="form-control" id="courriel" ng-model="compte.courriel" placeholder="Entrez votre courriel" name="courriel">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="motPasse">Mot de passe</label>
                            <input type="password" class="form-control" id="motPasse" ng-model="compte.motPasse" placeholder="Entrez votre mot de passe" name="motPasse">
                        </div>
                        <div class="form-group col-lg-12">
                            <button class="btn btn-primary">Se connecter</button>
                            <a href='account/create' class="btn btn-success">S'incrire</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

         <!-- =============== Scripts =============== -->
        <script src="./lib/angular-1.6.7/angular.min.js"></script>
        <script src="scripts/myApp.mdl.js"></script>
        <script src="scripts/compte.ctrl.js"></script>
    </body>
</html>
