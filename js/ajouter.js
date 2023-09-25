/***************************************************************************************************
---------------------------------------- Validation ------------------------------------------------
****************************************************************************************************/
let nom = document.getElementById("nom");
let date = document.getElementById("date");
let lien = document.getElementById("lien");
let image = document.getElementById("image");

let invalidNom = document.getElementById("invalidNom");
let invalidDate = document.getElementById("invalidDate");
let invalidLien = document.getElementById("invalidLien");
let invalidImage = document.getElementById("invalidImage");

let inputNom;
let inputDate;
let inputLien;
let inputImage;

const regexURL = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;

nom.addEventListener("input", function(event){
    inputNom = nom.value;
    
    if(inputNom === "" || inputNom === null){
        invalidNom.style.display = "block";
        nom.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidNom.style.display = "none";
        nom.setAttribute("class", "form-control is-valid");
    }

});

date.addEventListener("input", function(event){
    inputDate = date.value;

    if(inputDate === "" || inputDate === null){
        invalidDate.style.display = "block";
        date.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidDate.style.display = "none";
        date.setAttribute("class", "form-control is-valid");
    }
});

lien.addEventListener("input", function(event){
    inputLien = lien.value;

    if(inputLien === "" || inputLien === null){
        invalidLien.style.display = "none";
        lien.setAttribute("class", "form-control");
    }
    else if(!(regexURL.test(inputLien))){
        invalidLien.style.display = "block";
        invalidLien.innerHTML = "L'URL n'est pas valide";
        lien.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidLien.style.display = "none";
        lien.setAttribute("class", "form-control is-valid");
    }
});

image.addEventListener("input", function(event){
    inputImage = image.value;

    if(inputImage === "" || inputImage === null){
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control");
    }
    else if(!(regexURL.test(inputImage))){
        invalidImage.style.display = "block";
        image.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control is-valid");
    }
});

/***************************************************************************************************
----------------------------------- Liste des programmes -------------------------------------------
****************************************************************************************************/
let containerDepartement = document.getElementById("containerDepartement");

const rowDepartement = document.querySelector(".original-row");
const boutonAjouter = document.querySelector(".btn-ajouterDept");
const boutonSupprimer = document.querySelector(".btn-supprimerDept");
let selectDepartement = document.getElementsByTagName("select");

boutonAjouter.addEventListener("click", clonerRow);
boutonSupprimer.style.display = "none";

let departementLength = document.createElement("input");
departementLength.style.display = "none";
departementLength.setAttribute("type", "number");
departementLength.setAttribute("name", "departementLength");
departementLength.setAttribute("value", selectDepartement.length);
containerDepartement.append(departementLength);

function clonerRow(){
    const nouvelleRowDepartement = rowDepartement.cloneNode(true);

    const nouveauBoutonAjouter = nouvelleRowDepartement.querySelector(".btn-ajouterDept");
    nouveauBoutonAjouter.addEventListener("click", clonerRow);

    const nouveauBoutonSupprimer = nouvelleRowDepartement.querySelector(".btn-supprimerDept");
    nouveauBoutonSupprimer.style.display = "Block";
    nouveauBoutonSupprimer.addEventListener("click", function(){
        nouvelleRowDepartement.remove();
        changeSelectName();
    });

    containerDepartement.append(nouvelleRowDepartement);
    changeSelectName();
}

function changeSelectName(){
    for(let i=0;i<selectDepartement.length;i++){
        console.log(selectDepartement);
        let nomTemp = "departement" + i;
        selectDepartement[i].setAttribute("name", nomTemp);
    }
    updateDepartementLength();
}

function updateDepartementLength(){
    departementLength.setAttribute("value", selectDepartement.length);
}