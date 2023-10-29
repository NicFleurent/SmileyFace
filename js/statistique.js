'use strict';

/* global Chart */

document.addEventListener('DOMContentLoaded', function () {
    //Affiche le nom de l'event
    document.getElementById('titre-event').textContent = document.getElementById('titreE').textContent;
    //Graphique Étudiants
    const ctxEt = document.getElementById('canvas-diagramme').getContext('2d');
    //Récupération nombre de votes
    let nbEtudSatisf = parseInt(document.getElementById('nbEtudSatisf').textContent);
    let nbEtudNeutre = parseInt(document.getElementById('nbEtudNeutre').textContent);
    let nbEtudInsatisf = parseInt(document.getElementById('nbEtudInsatisf').textContent);
    //Obtention du pourcentage
    let totalVotes = (nbEtudSatisf + nbEtudNeutre + nbEtudInsatisf);
    let pourcentageEtudSatisf = Math.round((nbEtudSatisf * 100) / totalVotes);
    let pourcentageEtudNeutre = Math.round((nbEtudNeutre) * 100 / totalVotes);
    let pourcentageEtudInsatisf = Math.round((nbEtudInsatisf * 100) / totalVotes);
    //Affichage nb votes
    document.getElementById('totalVotesEt').textContent = 'Total de votes : ' + totalVotes;
    //Création de tableaux pour les données
    let tabStatsEt = [nbEtudSatisf, nbEtudNeutre, nbEtudInsatisf];
    let tabLabelEt = ['Étudiants satisfaits' + '(' + pourcentageEtudSatisf + '%' + ')',
    'Étudiants neutres' + '(' + pourcentageEtudNeutre + '%' + ')',
    'Étudiants insatisfaits' + '(' + pourcentageEtudInsatisf + '%' + ')'];
    let titreGraphEt = document.getElementById('titre-etu');


    if (tabStatsEt[0] === 0 && tabStatsEt[1] === 0 && tabStatsEt[2]===0) {
        titreGraphEt.textContent = 'Aucune donnée n\'a été enregistrée pour les étudiants';
    }
    else {
        titreGraphEt.textContent = 'Satisfaction des étudiants';
        const dataChartJs = {
            labels: tabLabelEt,
            datasets: [
                {
                    label: 'Votes',
                    data: tabStatsEt,
                    backgroundColor: [
                        'rgba(70, 190, 40, 1)',
                        'rgba(255, 220, 40, 1)',
                        'rgba(220, 10, 11, 1)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth:4 ,
                },
            ]
        };

        // Les options du diagramme.
        const optionsChartJs = {
        };

        // eslint-disable-next-line no-unused-vars  
        let diagChartJs = new Chart(ctxEt, {
            type: 'pie',
            data: dataChartJs,
            options: optionsChartJs
        });
    }

    //Graphique Entreprise
    const ctxEn = document.getElementById('canvas-diagramme2').getContext('2d');
    //Récupération des stats 
    let nbEntreSatisf = parseInt(document.getElementById('nbEntSatisf').textContent);
    let nbEntreNeutre = parseInt(document.getElementById('nbEntNeutre').textContent);
    let nbEntreInsatisf = parseInt(document.getElementById('nbEntInsatisf').textContent);
    //Obtention en pourcentage
    let totalVotesEnt = (nbEntreSatisf + nbEntreNeutre + nbEntreInsatisf);
    let pourcentageEntreSatisf = Math.round((nbEntreSatisf * 100) / totalVotesEnt);
    let pourcentageEntreNeutre = Math.round((nbEntreNeutre) * 100 / totalVotesEnt);
    let pourcentageEntreInsatisf = Math.round((nbEntreInsatisf * 100) / totalVotesEnt);
    let tabStatsEn = [nbEntreSatisf, nbEntreNeutre, nbEntreInsatisf];
    let tabLabelEn = ['Entreprises satisfaites' + '(' + pourcentageEntreSatisf + '%' + ')',
    'Entreprises neutres' + '(' + pourcentageEntreNeutre + '%' + ')',
    'Entreprises insatisfaites' + '(' + pourcentageEntreInsatisf + '%' + ')'];
    //Affichage total nb votes entreprises
    document.getElementById('totalVotesEn').textContent = 'Total de votes : ' + totalVotesEnt;
    let titreGraphEn = document.getElementById('titre-ent');

    if (tabStatsEn[0] === 0 && tabStatsEn[1] === 0 && tabStatsEn[2]===0) {
        titreGraphEn.textContent = 'Aucune donnée n\'a été enregistrée pour les entreprises';
    }
    else {
        titreGraphEn.textContent = 'Satisfaction des entreprises';
        const dataChartJsEn = {
            labels: tabLabelEn,
            datasets: [
                {
                    label: 'Votes',
                    data: tabStatsEn,
                    backgroundColor: [
                        'rgba(70, 190, 40, 1)',
                        'rgba(255, 220, 40, 1)',
                        'rgba(220, 10, 11, 1)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth:4 ,
                },
            ]
        };

        // Les options du diagramme.
        const optionsChartJsEn = {
        };

        // eslint-disable-next-line no-unused-vars  
        let diagChartJsEn = new Chart(ctxEn, {
            type: 'pie',
            data: dataChartJsEn,
            options: optionsChartJsEn
        });
    }

});

