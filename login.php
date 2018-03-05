<?php
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
    <body ng-controller="espaceCtrl">

        <div class="container" ng-controller="compteCtrl">
            <div class="panel panel-primary col-lg-6 col-lg-offset-3 ">
                <div class="panel panel-body">
                    <form class="form-account" method="POST">
                        <h1>Page de connexion</h1>
                        <div class="form-group col-lg-12">
                            <label for="email">Courriel</label>
                            <input type="email" class="form-control" id="email" placeholder="Entrez votre courriel" name="email">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" name="password">
                        </div>
                        <div class="form-group col-lg-12">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
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
