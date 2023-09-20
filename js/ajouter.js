/***************************************************************************************************
---------------------------------------- Validation ------------------------------------------------
****************************************************************************************************/
let nom = document.getElementById("nom");
let date = document.getElementById("date");
let lien = document.getElementById("lien");
let image = document.getElementById("image");
let departement = document.getElementById("departement");

let invalidNom = document.getElementById("invalidNom");
let invalidDate = document.getElementById("invalidDate");
let invalidLien = document.getElementById("invalidLien");
let invalidImage = document.getElementById("invalidImage");
let invalidDepartement = document.getElementById("invalidDepartement");

let inputNom;
let inputDate;
let inputLien;
let inputImage;
let inputDepartement;

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

/*
buttonListenerSetup();
let ctr = 0;

function buttonListenerSetup(){
    for(let i=0;i<btnAjouterDept.length;i++){
        if(btnAjouterDept[i].getAttribute("class") !== "btn btn-outline-light btn-ajouterDept btn-pret fw-bold"){
            btnAjouterDept[i].addEventListener("click", function(){

                let rowDepartement = document.getElementById("rowDepartement"+ctr);
                let nouvelleRowDepartement = rowDepartement.cloneNode(true);
                nouvelleRowDepartement.setAttribute("id", "rowDepartement"+ ++ctr);
                btnAjouterDept[i].setAttribute("class", "btn btn-outline-light btn-ajouterDept btn-pret fw-bold");

                containerDepartement.append(nouvelleRowDepartement);

                buttonListenerSetup();
            });
        }
        else{
            btnAjouterDept[i].disabled = true;
            btnSupprimerDept[i].disabled = true;
        }
    }

    for(let i=0;i<btnSupprimerDept.length;i++){
        if(btnSupprimerDept[i].getAttribute("class") !== "btn btn-outline-light btn-supprimerDept btn-pret fw-bold"){
            btnSupprimerDept[i].addEventListener("click", function(){
                btnAjouterDept[i-1].disabled = false;
                btnSupprimerDept[i-1].disabled = false;

                let rowDepartement = document.getElementById("rowDepartement"+ctr--);
                rowDepartement.remove();

                btnSupprimerDept[i].setAttribute("class", "btn btn-outline-light btn-supprimerDept btn-pret fw-bold");

                containerDepartement.append(nouvelleRowDepartement);
            });
        }
    }
}*/