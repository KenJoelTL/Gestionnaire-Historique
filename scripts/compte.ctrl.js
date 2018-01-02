//Définition d'un controleur pour le module myApp
myApp.controller('compteCtrl', ['$scope', '$http', function($scope, $http) {
    console.log("Coucou du controleur Compte!");

    $scope.afficherComptes = function() {
        console.log("fonction pour afficher les comptes");
        $http.get('controleur-frontal-services.php', {
            params: {
                action: "listeCompte"
            }
        }).
        then(function(response) {
            $scope.comptes = response.data;
            //console.log(response.data);
        });
    };

    /*
    $scope.afficherComptes = function(){
    	console.log("fonction pour afficher les comptes");
    	$http({
    		method:'GET',
    		url : 'controleur-frontal-services.php',
    		params:{
    			action:"listeCompte"
    		}
    	}).then(function(response){
    		$scope.comptes = response.data;
    		console.log(response.data);
    	});
    };*/


    //fonction pour reinitialiser le contact sélectionné
    $scope.deselectionnerContact = function() {
        $scope.compte = null;
    };

    var deselectionnerContact = $scope.deselectionnerContact;

    //fonction pour rafraichir la page.
    var rafraichir = function() {
        $scope.afficherComptes();
        deselectionnerContact();
    };

    rafraichir(); // la fonction sera appelée lors du démmarage de l'app

    //fonction pour ajouter un contact à la base de données
    $scope.ajouterCompte = function() {
        console.log($scope.compte); //contact à ajouter à la bd
        $http.post('../controleur-frontal-services.php', {
            action: "ajoutCompte",
            compte: $scope.compte
        }).then(function(response) {
            console.log(response.data); //contact ajouté à la bd
            //$scope.afficherComptes();
            rafraichir();
        });
    };

    //fonction pour supprimer un contact de la bd
    $scope.supprimerCompte = function(id_compte) {
        $http.post('../controleur-frontal-services.php', {
            action: "suppressionCompte",
            id: id_compte
        }).
        then(function(response) {
            console.log("Suppression");
            console.log(response.data);
            //    rafraichir();
            $scope.afficherComptes();
        });
    };

    //fonction pour chercher un contact de la bd et le selectionner(mettre dans le formulaire)
    $scope.chercherCompte = function(id_compte) {
        console.log(id_compte);
        deselectionnerContact();

        $http.get('../controleur-frontal-services.php', {
            params: {
                action: "rechercheCompte",
                id: id_compte
            }
        }).
        then(function(response) {
            $scope.compte = response.data;
            console.log(response.data);
        });
    };

    //fonction pour modifier le contact sélectionné (dans le formulaire)
    $scope.modifierCompte = function() {
        console.log("Modification");
        console.log($scope.compte.id);

        $http.put('../controleur-frontal-services.php', {
            action: 'modificationCompte',
            id: $scope.compte.id,
            compte: $scope.compte
        }).
        then(function(response) {
            console.log(response.data);
            rafraichir();
        });

    };


}]);
