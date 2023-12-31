<?php
//Démarre la session
session_start();
if ($_SESSION['serveur']) {
    require("connexionServeur.php");
} else {
    require("connexionLocal.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/statistique.css">
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
    ?>
        <div class="container-fluid vh-100 d-flex flex-column justify-content-between p-0">
            <header>
                <nav class="navbar navbar-expand-lg mb-5">
                    <div class="container-fluid ">
                        <a class="ms-5" href="index.php">
                            <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                        </a>
                        <!-- Mécanisme pour cacher les liens de la barre de navigation lorsque l'espace est insuffisant -->
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nav-menu" aria-controls="nav-menu" aria-expanded="false" aria-label="Bascule de la navigation">
                            <!-- image lignes pour hamburger" -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse  justify-content-end me-5" id="nav-menu">
                            <ul class="navbar-nav text-center mt-3">
                                <li class="nav-item ms-5">
                                    <a class="btn btn-outline-light" href="validation.php?destination=ajouter">Créer un évènement</a>
                                </li>
                                <li class="nav-item ms-5">
                                    <a class="btn btn-outline-light" href="validation.php?destination=listeProgramme">Programmes</a>
                                </li>
                                <li class="nav-item ms-5">
                                    <a class="btn btn-outline-light" href="validation.php?destination=listeUsager">Utilisateurs</a>
                                </li>
                                <li class="nav-item ms-5">
                                    <a class="btn btn-outline-light" href="deconnexion.php">Déconnexion <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                        </svg></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="container">

                <?php

                //Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                //Check connection
                if (!$conn) {
                    die("Connectionfailed:" . mysqli_connect_error());
                }

                if (isset($_GET['id'])) {
                    $id = test_input($_GET['id']);

                    $sql = "SELECT * FROM evenement WHERE id=$id";
                    $result = $conn->query($sql);

                    if (!($result->num_rows > 0)) {
                        mysqli_close($conn);
                        header("Location: ./index.php");
                    }

                    //string de requête
                    $sql = "SELECT nom,etudiantSatisfait,etudiantNeutre,etudiantInsatisfait FROM evenement where id=$id";
                    $conn->query('SET NAMES utf8');

                    //L'action la query est ici
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <span id="titreE" class="visually-hidden"><?php echo $row['nom'] ?></span>
                            <span id="nbEtudSatisf" class="visually-hidden"> <?php echo $row['etudiantSatisfait'] ?></span>
                            <span id="nbEtudNeutre" class="visually-hidden"><?php echo $row['etudiantNeutre'] ?></span>
                            <span id="nbEtudInsatisf" class="visually-hidden"><?php echo $row['etudiantInsatisfait'] ?></span>

                        <?php
                        }
                    }
                    $sql = "SELECT employeurSatisfait,employeurNeutre,employeurInsatisfait FROM evenement where id=$id";
                    $conn->query('SET NAMES utf8');

                    //L'action la query est ici
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <span id="nbEntSatisf" class="visually-hidden"><?php echo $row['employeurSatisfait'] ?></span>
                            <span id="nbEntNeutre" class="visually-hidden"><?php echo $row['employeurNeutre'] ?></span>
                            <span id="nbEntInsatisf" class="visually-hidden"><?php echo $row['employeurInsatisfait'] ?></span>
                <?php
                        }
                    }
                }
                ?>

                <h1 class="text-center" id="titre-event"></h1>
                <!-- Pour avoir un bon comportement responsive, il faut ajouter les styles ci-dessous
                    dans le conteneur du "canvas" -->

                <div class="row">
                    <div class="col-lg-6 justify-content-center text-center mt-5">
                        <h2 id="titre-etu"></h2>
                        <div class="mx-auto" style="position: relative; height: 361px; width: 361px;">
                            <canvas id="canvas-diagramme"></canvas>
                        </div>
                        <span class="fs-4" id="totalVotesEt"></span>
                    </div>
                    <div class="col-lg-6 justify-content-center text-center mt-5">
                        <h2 id="titre-ent"></h2>
                        <div class="mx-auto" style="position: relative; height: 361px; width: 361px;">
                            <canvas id="canvas-diagramme2"></canvas>
                        </div>
                        <span class="fs-4" id="totalVotesEn"></span>
                    </div>
                </div>
            </div>
        <?php
        $conn->close();
    } else {
        header("Location: ./connexion.php");
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        ?>

        <footer class="mt-5 w-100">
            <!-- Copyright -->
            <div class="d-flex w-100 justify-content-center">
                <div class="d-flex flex-column justify-content-center text-center me-5">
                    <p class="mb-2">Réalisé par:</p>
                    <p class="mb-0">Nicolas Fleurent</p>
                    <p class="mb-0">Mirolie Théroux</p>
                </div>

                <img src="img/Logo_offic_2L_Techniques_informatique-01.png" alt="Logo tech">
            </div>
        </footer>
        </div>

        <!-- Bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="js/statistique.js"></script>
</body>

</html>