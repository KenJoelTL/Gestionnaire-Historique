//Définition d'un controleur pour le module myApp
myApp.controller('sousEspaceCtrl', ['$scope', '$http', function($scope, $http) {
    console.log("Coucou du controleur SousEspace!");

    $scope.afficherSousEspaces = function() {
        console.log("fonction pour afficher les sous-espaces");
        $http.get('controleur-frontal-services.php', {
            params: {
                action: "listeSousEspace"
            }
        }).
        then(function(response) {
            console.log(response.data);
            //$scope.error = response.data.error;
            $scope.sousEspaces = response.data;
        });
    };


    //fonction pour reinitialiser l'espace sélectionné
    $scope.deselectionnerSousEspace = function() {
        $scope.sousEspace = null;
    };

    var deselectionnerSousEspace = $scope.deselectionnerSousEspace;

    //fonction pour rafraichir la page.
    var rafraichir = function() {
        $scope.afficherSousEspaces();
        deselectionnerSousEspace();
    };

    rafraichir(); // la fonction sera appelée lors du démmarage de l'app

    //fonction pour ajouter un sous-espace à la base de données
    $scope.ajouterSousEspace = function() {
        console.log($scope.sousEspace); // sous-espace à ajouter à la bd
        $http.post('controleur-frontal-services.php', {
            action: "ajoutSousEspace",
            sousEspace: $scope.sousEspace
        }).
        then(function(response) {
            console.log(response.data); //sous-espace ajouté à la bd
            rafraichir();
        });
    };

    //fonction pour supprimer un espace de la bd
    $scope.supprimerSousEspace = function(id_sous_espace) {
        $http.post('controleur-frontal-services.php', {
            action: "suppressionSousEspace",
            id: id_sous_espace
        }).
        then(function(response) {
            console.log("Suppression de sous-espace");
            console.log(response.data);
            //    rafraichir();
            $scope.afficherSousEspaces();
        });
    };


    //fonction pour chercher un sous-espace de la bd et le selectionner(mettre dans le formulaire)
    $scope.chercherSousEspace = function(id_sous_espace) {
        console.log(id_sous_espace);
        deselectionnerSousEspace();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheSousEspace",
                id: id_sous_espace
            }
        }).
        then(function(response) {
            $scope.sousEspace = response.data;
            console.log(response.data);
        });
    };

    //fonction pour modifier l'espace sélectionné (dans le formulaire)
    $scope.modifierSousEspace = function() {
        console.log("Modification");
        console.log($scope.sousEspace.id);

        $http.put('controleur-frontal-services.php', {
            action: 'modificationSousEspace',
            id: $scope.sousEspace.id,
            sousEspace: $scope.sousEspace
        }).
        then(function(response) {
            console.log(response.data);
            rafraichir();
        });

    };


    //fonction pour chercher une liste des sous-espaces d'un espace donné
    $scope.chercherSousEspaceParEspace = function(id_espace) {
        console.log(id_espace);
        //deselectionnerSousEspace();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheSousEspaceParEspace",
                id: id_espace
            }
        }).
        then(function(response) {
            $scope.sousEspaces = response.data;
            console.log(response.data);
        });
    };





}]);
