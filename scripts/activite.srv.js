myApp.service("activiteSrv",["$http",function($http) {
    this.getAllActivite = function() {
        $http.get('controleur-frontal-services.php', {
            params: {
                action: "listeActivite"
            }
        }).
        then(function(response) {
            console.log(response.data);
            return response.data;
        });
    };
/*
    this.addActivite = function(activite_obj){
        $http.post('controleur-frontal-services.php', {
            action: "ajoutActivite",
            activite: activite_obj
        }).
        then(function(response) {
            console.log(response.data); //activité ajoutée à la bd
        });
    };

    this.deleteActivite = function(id_activite){
        $http.post('controleur-frontal-services.php', {
            action: "suppressionActivite",
            id: id_activite
        }).
        then(function(response) {
            console.log("Suppression d'activité");
            console.log(response.data);
        });
    };

*/
}]);
