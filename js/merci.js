const retourPageVote = setTimeout(pageRetour, 2500);

let etudiant = document.getElementById("etudiant");
let employeur = document.getElementById("employeur");
let erreur = document.getElementById("erreur");

let sorties = document.getElementsByClassName("d-none");

function pageRetour(){

    if(etudiant != null){
        window.location.href = etudiant.innerHTML;
    }
    else if(employeur != null){
        window.location.href = employeur.innerHTML;
    }
    else{
        window.location.href = "index.php";
    }
}