<?php
//Démarre la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mb-2 mb-lg-0  align-items-center w-100 justify-content-between px-5">
                        <li class="nav-item">
                            <a href="index.php">
                                <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                            </a>
                        </li>
                        <li class="nav-item ms-5">
                            <form>
                                <input id="barreRecherche " class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                            </form>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="validation.php?destination=ajouter">Créer un évènement</a>
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

    <main class="container">

        <?php
        if ($_SESSION['connexion'] == true) {
            //Variables connexion
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "smileyface";
            //Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            //Check connection
            if (!$conn) {
                die("Connectionfailed:" . mysqli_connect_error());
            }
            // Set session variables
            $_SESSION["connexion"] = true;

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

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
            } else {
                header("Location: ./index.php");
            }
        } else {
            header("Location: ./connexion.php");
        }
        ?>

        <h1 class="text-center" id="titre-event"></h1>
        <!-- Pour avoir un bon comportement responsive, il faut ajouter les styles ci-dessous
             dans le conteneur du "canvas" -->

        <div class="d-flex justify-content-center mt-5 canvas-container ">
            <div class="me-5 text-center">
                <h2 id="titre-etu"></h2>
                <div class="position-relative">
                    <canvas id="canvas-diagramme"></canvas>
                </div>
                <span  class="fs-4" id="totalVotesEt"></span>
            </div>
            <div class="ms-5 text-center">
                <h2 id="titre-ent"></h2>
                <div class="position-relative">
                    <canvas id="canvas-diagramme2"></canvas>
                </div>
                <span class="fs-4" id="totalVotesEn"></span>
            </div>
        </div>
    </main>


    <footer class="text-center mt-5">
        <!-- Copyright -->
        <p>
            © 2023 Copyright: Nicolas Fleurent & Mirolie Théroux
        </p>
    </footer>


    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/statistique.js"></script>
</body>

</html>