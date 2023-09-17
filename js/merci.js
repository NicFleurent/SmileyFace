const retourPageVote = setTimeout(pageRetour, 2500);

let etudiant = document.getElementById("etudiant");
let employeur = document.getElementById("employeur");
let erreur = document.getElementById("erreur");


function pageRetour(){

    if(etudiant != null){
        window.location.href = "satisfactionEtudiant.php";
    }
    else if(employeur != null){
        window.location.href = "satisfactionEmployeur.php";
    }
    else{
        window.location.href = "index.php";
    }
}