function ouvrir(classeActivite) {
    var activites = document.getElementsByClassName(classeActivite);

    for(var i = 0; i<activites.length; i++) {
        console.log(activites[i]);
        activites[i].click();
//        a.click();
    }

console.log("fonction OUVRIR" + classeActivite);

}/*
function ouvrir(event, ordre){
    var classe = event.source.class;
    var classeActivite = classe.split(ordre)[1];
    var activites = document.getElementsByClass(classeActivite);

    for(var a in activites) {
        a.click();
    }
}*/
