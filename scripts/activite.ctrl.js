//Définition d'un controleur pour le module myApp
myApp.controller('activiteCtrl', ['$scope', '$http', function($scope, $http) {
    console.log("Coucou du controleur Activité!");

    $scope.afficherActivites = function() {
        console.log("fonction pour afficher les activités");
        $http.get('controleur-frontal-services.php', {
            params: {
                action: "listeActivite"
            }
        }).
        then(function(response) {
            console.log(response.data);
            //$scope.error = response.data.error;
            $scope.activites = response.data;
        });
    };


    //fonction pour reinitialiser l'activité sélectionnéee
    $scope.deselectionnerActivite = function() {
        $scope.activite = null;
    };

    var deselectionnerActivite = $scope.deselectionnerActivite;

    //fonction pour rafraichir la page.
    var rafraichir = function() {
        $scope.afficherActivites();
        deselectionnerActivite();
    };

    rafraichir(); // la fonction sera appelée lors du démmarrage de l'app



    //fonction pour ajouter une activité à la base de données
    $scope.ajouterActivite = function() {
        console.log($scope.activite); // activité à ajouter à la bd
        if($scope.activite !== null){
            delete $scope.activite.id;
            $http.post('controleur-frontal-services.php', {
                action: "ajoutActivite",
                activite: $scope.activite
            }).
            then(function(response) {
                console.log(response.data); //activité ajoutée à la bd
                rafraichir();
            });
        }
    };

    //fonction pour supprimer une activité de la bd
    $scope.supprimerActivite = function(id_activite) {
        $http.post('controleur-frontal-services.php', {
            action: "suppressionActivite",
            id: id_activite
        }).
        then(function(response) {
            console.log("Suppression d'activité");
            console.log(response.data);
            //    rafraichir();
            $scope.afficherActivites();
        });
    };


    //fonction pour chercher une activité de la bd et la selectionner(mettre dans le formulaire)
    $scope.chercherActivite = function(id_activite) {
        console.log(id_activite);
        deselectionnerActivite();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheActivite",
                id: id_activite
            }
        }).
        then(function(response) {
            $scope.activite = response.data;
            console.log(response.data);
        });
    };

    //fonction pour modifier l'activité sélectionnée (dans le formulaire)
    $scope.modifierActivite = function() {
        console.log("Modification");
        console.log($scope.activite.id);

        $http.put('controleur-frontal-services.php', {
            action: 'modificationActivite',
            id: $scope.activite.id,
            activite: $scope.activite
        }).
        then(function(response) {
            console.log(response.data);
            rafraichir();
        });

    };


    //fonction pour chercher une liste des activités d'un sous-espace donnée
    $scope.chercherActiviteParSousEspace = function(id_sous_espace) {
        console.log(id_sous_espace);
        //deselectionnerSousEspace();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheActiviteParSousEspace",
                id: id_sous_espace
            }
        }).
        then(function(response) {
            $scope.activites = response.data;
            console.log(response.data);
        });
    };

    //doit être remplasser par un service
    //fonction pour chercher une liste des activités d'un sous-espace donnée
    $scope.getActiviteParSousEspace = function(id_sous_espace) {
        //console.log(id_sous_espace);
        //deselectionnerSousEspace();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheActiviteParSousEspace",
                id: id_sous_espace
            }
        }).
        then(function(response) {
            console.log(reponse.data);
            return response.data;
        });
    };


}]);
