var myApp = angular.module('myApp',[]);

//Définition d'un controleur pour le module myApp
myApp.controller('AppCtrl',['$scope','$http',function($scope,$http){
  console.log("Coucou du controleur !");

    $scope.test = function(){
        console.log('Function test');
        $http.get('controleur-frontal-services.php').then(function(response){
            $scope.compte = response.data;
            console.log(response.data);
        });
    };

    $scope.afficherComptes = function(){
        console.log("fonction pour afficher les comptes");
        $http.get('controleur-frontal-services.php', { params : { action:"listeCompte" } }).
            then(function(response){
                $scope.comptes = response.data;
                console.log(response.data);
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
/*
  //fonction pour reinitialiser le contact sélectionné
  $scope.deselectionnerContact = function(){
    $scope.contact = null;
  };

  var deselectionnerContact = $scope.deselectionnerContact;

  //fonction pour rafraichir la page.
  var rafraichir = function(){
    //action lorsque requete get /contactlist
    $http.get('/contactlist').then(function(response){
      //console.log("J'ai reçu les données que j'ai demandées");
      $scope.listeContacts = response.data;
      deselectionnerContact();
    });
  };

  rafraichir(); // la fonction sera appelée lors du démmarage de l'app

  //fonction pour ajouter un contact à la base de données
  $scope.ajouterContact = function(){
    //console.log($scope.contact); //contact à ajouter à la bd
    $http.post('/contactlist', $scope.contact).then(function(response){
      //console.log(response.data); //contact ajouté à la bd
      rafraichir();
    });
  };
*/
  //fonction pour supprimer un contact de la bd
  $scope.supprimerCompte = function(id_compte){
    //console.log(id);
    $http.post(
        'controleur-frontal-services.php',
        {
            action: "suppressionCompte", id : id_compte }
        ).
        then(function(response){
            console.log("Suppression");
            console.log(response.data);
            $scope.afficherComptes();
        });
  };
/*
  //fonction pour chercher un contact de la bd et le selectionner(mettre dans le formulaire)
  $scope.chercherContact = function(id){
    //console.log(id);
    deselectionnerContact();
    $http.get('/contactlist/'+id).then(function(response){
        $scope.contact = response.data;
    });
  };

  //fonction pour modifier le contact sélectionné (dans le formulaire)
  $scope.modifierContact = function(){
    //console.log($scope.contact._id);
    $http.put('/contactlist/'+$scope.contact._id, $scope.contact).then( function(response){
        //console.log(response.data);
        rafraichir();
    });
  };
*/

}]);
