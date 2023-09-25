/***************************************************************************************************
---------------------------------------- Validation ------------------------------------------------
****************************************************************************************************/
let nom = document.getElementById("nom");
let date = document.getElementById("date");
let lien = document.getElementById("lien");
let image = document.getElementById("image");
let btnEnvoyer = document.getElementById("btnEnvoyer");

let invalidNom = document.getElementById("invalidNom");
let invalidDate = document.getElementById("invalidDate");
let invalidLien = document.getElementById("invalidLien");
let invalidImage = document.getElementById("invalidImage");

let inputNom;
let inputDate;
let inputLien;
let inputImage;

let erreurNom = false;
let erreurDate = false;
let erreurLien = false;
let erreurImage = false;

const regexURL = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;

nom.addEventListener("input", function(event){
    inputNom = nom.value;
    
    if(inputNom === "" || inputNom === null){
        invalidNom.style.display = "block";
        nom.setAttribute("class", "form-control is-invalid");
        erreurNom = true;
        controlSubmit();
    }
    else{
        invalidNom.style.display = "none";
        nom.setAttribute("class", "form-control is-valid");
        erreurNom = false;
        controlSubmit();
    }

});

date.addEventListener("input", function(event){
    inputDate = date.value;

    if(inputDate === "" || inputDate === null){
        invalidDate.style.display = "block";
        date.setAttribute("class", "form-control is-invalid");
        erreurDate = true;
        controlSubmit();
    }
    else{
        invalidDate.style.display = "none";
        date.setAttribute("class", "form-control is-valid");
        erreurDate = false;
        controlSubmit();
    }
});

lien.addEventListener("input", function(event){
    inputLien = lien.value;

    if(inputLien === "" || inputLien === null){
        invalidLien.style.display = "none";
        lien.setAttribute("class", "form-control");
        erreurLien = false;
        controlSubmit();
    }
    else if(!(regexURL.test(inputLien))){
        invalidLien.style.display = "block";
        invalidLien.innerHTML = "L'URL n'est pas valide";
        lien.setAttribute("class", "form-control is-invalid");
        erreurLien = true;
        controlSubmit();
    }
    else{
        invalidLien.style.display = "none";
        lien.setAttribute("class", "form-control is-valid");
        erreurLien = false;
        controlSubmit();
    }
});

image.addEventListener("input", function(event){
    inputImage = image.value;

    if(inputImage === "" || inputImage === null){
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control");
        erreurImage = false;
        controlSubmit();
    }
    else if(!(regexURL.test(inputImage))){
        invalidImage.style.display = "block";
        image.setAttribute("class", "form-control is-invalid");
        erreurImage = true;
        controlSubmit();
    }
    else{
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control is-valid");
        erreurImage = false;
        controlSubmit();
    }
});

function controlSubmit(){
    if(erreurNom || erreurDate || erreurLien || erreurImage){
        btnEnvoyer.disabled = true;
    }
    else{
        btnEnvoyer.disabled = false;
    }
}

/***************************************************************************************************
----------------------------------- Liste des programmes -------------------------------------------
****************************************************************************************************/
let containerDepartement = document.getElementById("containerDepartement");

const rowDepartement = document.querySelectorAll(".original-row");
const boutonAjouter = document.querySelectorAll(".btn-ajouterDept");
const boutonSupprimer = document.querySelectorAll(".btn-supprimerDept");
let selectDepartement = document.getElementsByTagName("select");

boutonAjouter.forEach(bouton => {
    bouton.addEventListener("click", clonerRow);
});

for(let i=0;i<boutonSupprimer.length;i++){
    console.log(boutonSupprimer[i]);
    if(i === 0){
        boutonSupprimer[i].style.display = "none";
    }
    else{
        boutonSupprimer[i].style.display = "block";
        boutonSupprimer[i].addEventListener("click", function(){
            rowDepartement[i].remove();
            changeSelectName();
        });
    }
}

let departementLength = document.createElement("input");
departementLength.style.display = "none";
departementLength.setAttribute("type", "number");
departementLength.setAttribute("name", "departementLength");
departementLength.setAttribute("value", selectDepartement.length);
containerDepartement.append(departementLength);

changeSelectName();

function clonerRow(){
    const nouvelleRowDepartement = rowDepartement[0].cloneNode(true);

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

