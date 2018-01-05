//Définition d'un controleur pour le module myApp
myApp.controller('espaceCtrl', ['$scope', '$http', function($scope, $http) {
    console.log("Coucou du controleur Espace!");

    $scope.afficherEspaces = function() {
        console.log("fonction pour afficher les espaces");
        $http.get('controleur-frontal-services.php', {
            params: {
                action: "listeEspace"
            }
        }).
        then(function(response) {
            console.log(response.data);
            //$scope.error = response.data.error;
            $scope.espaces = response.data;
        });
    };


    //fonction pour reinitialiser l'espace sélectionné
    $scope.deselectionnerEspace = function() {
        $scope.espace = null;
    };

    var deselectionnerEspace = $scope.deselectionnerEspace;

    //fonction pour rafraichir la page.
    var rafraichir = function() {
        $scope.afficherEspaces();
        deselectionnerEspace();
    };

    rafraichir(); // la fonction sera appelée lors du démmarage de l'app

    //fonction pour ajouter un espace à la base de données
    $scope.ajouterEspace = function() {
        console.log($scope.espace); //espace à ajouter à la bd
        $http.post('controleur-frontal-services.php', {
            action: "ajoutEspace",
            espace: $scope.espace
        }).then(function(response) {
            console.log(response.data); //espace ajouté à la bd
            rafraichir();
        });
    };

    //fonction pour supprimer un espace de la bd
    $scope.supprimerEspace = function(id_espace) {
        $http.post('controleur-frontal-services.php', {
            action: "suppressionEspace",
            id: id_espace
        }).
        then(function(response) {
            console.log("Suppression d'espace");
            console.log(response.data);
            //    rafraichir();
            $scope.afficherEspaces();
        });
    };


    //fonction pour chercher un espace de la bd et le selectionner(mettre dans le formulaire)
    $scope.chercherEspace = function(id_espace) {
        console.log(id_espace);
        deselectionnerEspace();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheEspace",
                id: id_espace
            }
        }).
        then(function(response) {
            $scope.espace = response.data;
            console.log(response.data);
        });
    };

    //fonction pour modifier l'espace sélectionné (dans le formulaire)
    $scope.modifierEspace = function() {
        console.log("Modification");
        console.log($scope.espace.id);

        $http.put('controleur-frontal-services.php', {
            action: 'modificationEspace',
            id: $scope.espace.id,
            espace: $scope.espace
        }).
        then(function(response) {
            console.log(response.data);
            rafraichir();
        });

    };

    //fonction pour chercher une liste des espaces d'un compte donné
    $scope.chercherEspaceParCompte = function(id_compte) {
        console.log(id_compte);
        //deselectionnerCompte();

        $http.get('controleur-frontal-services.php', {
            params: {
                action: "rechercheEspaceParCompte",
                id: id_compte
            }
        }).
        then(function(response) {
            $scope.espaces = response.data;
            console.log(response.data);
        });
    };

}]);
