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
    <title>Évènements</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0  align-items-center">
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
                            <a class="btn btn-outline-light" href="ajouter.php">Créer un évenement</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="listeUsager.php">Utilisateurs</a>
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

            //string de requête
            $sql = "SELECT * FROM evenement WHERE date=current_date()";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            //  Afficher les évènements
            if ($result->num_rows > 0) {
        ?>
                <h1>Vos évènements aujourd'hui</h1>
                <ul class="row g-3 m-0">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <li class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card h-100 ">
                                <div class="card-header">
                                    <h2 class="text-center"><?php echo $row['nom'] ?></h2>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <img class="mb-3 card-img-top img-fluid" src="<?php echo $row['image'] ?>" alt="Image de l'évènement">
                                    <div class="mt-auto">
                                        <span class="card-text mb-4"><?php echo $row['date'] ?></span>
                                        <div class="text-center">
                                            <button id="<?php echo $row['id'] ?>" class="btn btn-outline-dark mx-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">Voir l'évènement</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php

                    }
                    ?>
                </ul>
            <?php
            }
            //string de requête
            $sql = "SELECT * FROM evenement WHERE date>current_date() order by date";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            //  Afficher les évènements
            if ($result->num_rows > 0) {
            ?>
                <h1>Vos évènements à venir</h1>
                <ul class="row g-3 m-0">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>

                        <li class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card h-100 ">
                                <div class="card-header">
                                    <h2 class="text-center"><?php echo $row['nom'] ?></h2>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <img class="mb-3 card-img-top img-fluid" src="<?php echo $row['image'] ?>" alt="Image de l'évènement">
                                    <div class="mt-auto">
                                        <span class="card-text mb-4"><?php echo $row['date'] ?></span>
                                        <div class="text-center">
                                            <button id="<?php echo $row['id'] ?>" class="btn btn-outline-dark mx-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">Voir l'évènement</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            }
            //string de requête
            $sql = "SELECT * FROM evenement WHERE date<current_date() order by date desc";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            //  Afficher les évènements
            if ($result->num_rows > 0) {
            ?>
                <h1>Vos évènements passés</h1>
                <ul class="row g-3 m-0">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>

                        <li class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card h-100 ">
                                <div class="card-header text-center">
                                    <h2 class="text-center"><?php echo $row['nom'] ?></h2>
                                    <span class="text-center fs-5"><?php echo $row['date'] ?></span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <img class="mb-3 card-img-top img-fluid" src="<?php echo $row['image'] ?>" alt="Image de l'évènement">
                                    <div class="mt-auto">
                                        <div class="text-center">
                                            <button id="<?php echo $row['id'] ?>" class="btn btn-outline-dark mx-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">Voir l'évènement</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
        <?php
            }
        } else {
            header("Location: ./connexion.php");
        }
        ?>

        <!-- OFF canvas-->
        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="evenement-offcanvas" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h2>Votre évenement</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card h-100 card-event">
                    <div class="card-header">
                        <h2 class="m-3 text-center"></h2>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <img src="" class="mb-3 card-img-top object-fit img-fluid w-75 " alt="Image de l'évènement">
                        <p class="card-text text-center mb-5 fs-3"></p>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="card-footer ">
                            <a id="btnChoixSondage" class="btn" href="choixSondage.php">
                                Débuter
                            </a>
                            <a id="btnStatistique" class="btn" href="#">
                                Statistiques
                            </a>
                            <a id="btnGerer" class="btn" href="modifier.php">
                                Gérer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>

</html>