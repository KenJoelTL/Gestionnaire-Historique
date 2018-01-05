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
        <div class="container-fluid" ng-controller="sousEspaceCtrl">
            <h1>Gestionnaire d'activit&eacute;s</h1>

            <div class="col-lg-2">
               <ul class="nav nav-pills nav-stacked list-group" ng-repeat="espace in $parent.espaces">
                  <li style="box-shadow: 1px 1px 4px 1px #033263a6"><a href="#" ng-click="chercherSousEspaceParEspace(espace.id)">{{espace.titre}}</a></li>
               </ul>
            </div>

            <div class="col-lg-8" ng-controller="activiteCtrl">
               <button class="btn btn-primary" ng-click="afficherSousEspaces()">Afficher tous les sous-espaces</button>
               <table class="table">
                  <tr>
                     <th>Id</th>
                     <th>Titre</th>
                     <th>Id de l'espace de travail</th>
                     <th>Action</th>
                  </tr>

                  <tr>
                     <th>--- ---</th>
                     <td><input type="text" class="form-control" ng-model="sousEspace.titre"></td>
                     <td><input type="number" class="form-control" ng-model="sousEspace.idEspace"></td>
                     <td><button class="btn btn-success" ng-click="ajouterSousEspace()">Ajouter</button>
                     <button class="btn btn-primary" ng-click="modifierSousEspace()">Modifier</button></td>
                  </tr>
               </table>

               <div class="col-lg-6" ng-repeat="sousEspace in sousEspaces">
                  <div class="panel panel-primary">
                     <div class="panel-heading">{{sousEspace.titre}}</div>
                     <div class="panel-body">
                        <ul class="list-group" ng-repeat="activite in activites" ng-if="activite.idSousEspace == sousEspace.id">
                           <li class="list-group-item">
                              <a href="{{activite.url}}" target="blank">{{activite.titre}}</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!--
               <tr >
                  div.panel.panel-primary
                  <td>{{sousEspace.id}}</td>
                  <td>{{sousEspace.titre}}</td>
                  <td>{{sousEspace.idEspace}}</td>
                  <td><button class="btn btn-danger" ng-click="supprimerSousEspace(sousEspace.id)">Supprimer</button>
                     <button class="btn btn-warning" ng-click="chercherSousEspace(sousEspace.id)">Selectionner</button></td>
               </tr>
               -->
            </div>

        </div>
         <!-- =============== Scripts =============== -->
        <script src="./lib/angular-1.6.7/angular.min.js"></script>
        <script src="scripts/myApp.mdl.js"></script>
        <script src="scripts/compte.ctrl.js"></script>
        <script src="scripts/espace.ctrl.js"></script>
        <script src="scripts/sous-espace.ctrl.js"></script>
        <script src="scripts/activite.ctrl.js"></script>
    </body>
</html>
