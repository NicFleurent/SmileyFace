<?php
//Démarre la session
session_start();
if($_SESSION['serveur']){
    require("connexionServeur.php");
}
else{
    require("connexionLocal.php");
}
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
        <nav class="navbar navbar-expand bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mb-2 mb-lg-0  align-items-center w-100 justify-content-between px-5">
                        <li class="nav-item">
                            <a href="index.php">
                                <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                            </a>
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
            $evenementsId = [];
            $evenementsNom = [];
            $evenementsDate = [];
            $evenementsImage = [];
            $evenementsLien = [];
            $i=0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $evenementsId[$i] = $row['id'];
                    $evenementsNom[$i] = $row['nom'];
                    $evenementsDate[$i] = $row['date'];
                    $evenementsImage[$i] = $row['image'];
                    $evenementsLien[$i] = $row['lien'];
                    $i++;
                }
        ?>
                <h1>Vos évènements aujourd'hui</h1>
                <?php
            }
                ?>
                <ul class="row g-3 m-0 w-100 justify-content-center">
                <?php
                    for($i=0 ; $i<count($evenementsId) ; $i++){

                    ?>
                        <li class="col-sm-6 col-md-4 col-xl-3 mb-3">
                            <div id="<?php echo $evenementsId[$i]; ?>" class="card h-100" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">
                                <div class="card-header text-center">
                                    <h2 class="titreEvenement"><?php echo $evenementsNom[$i]; ?></h2>
                                    <span class="card-text fs-5"><?php echo $evenementsDate[$i]; ?></span>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-center p-0">
                                    <img class="card-img-bottom object-fit img-fluid" src="<?php echo $evenementsImage[$i]; ?>" alt="Image de l'évènement">
                                </div>
                                    <span class="card-lien d-none"><?php echo $evenementsLien[$i]; ?></span>
                                <?php
                                $evenementsIdTemp = $evenementsId[$i];
                                $sql = "SELECT d.nom FROM evenement_departement ed INNER JOIN departement d ON d.id = ed.id_departement WHERE ed.id_evenement=$evenementsIdTemp";
                                $resultProgramme = $conn->query($sql);
                    
                                while($rowProgramme = $resultProgramme->fetch_assoc()){
                                ?>
                                    <span class="card-departement d-none"><?php echo $rowProgramme['nom']; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            //string de requête
            $sql = "SELECT * FROM evenement WHERE date>current_date() order by date";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            //  Afficher les évènements
            $evenementsId = [];
            $evenementsNom = [];
            $evenementsDate = [];
            $evenementsImage = [];
            $evenementsLien = [];
            $i=0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $evenementsId[$i] = $row['id'];
                    $evenementsNom[$i] = $row['nom'];
                    $evenementsDate[$i] = $row['date'];
                    $evenementsImage[$i] = $row['image'];
                    $evenementsLien[$i] = $row['lien'];
                    $i++;
                }
                ?>
                <h1>Vos évènements à venir</h1>
            <?php
            }
            ?>
                <ul class="row g-3 m-0 w-100 justify-content-center">
                <?php
                    for($i=0 ; $i<count($evenementsId) ; $i++){

                    ?>
                        <li class="col-sm-6 col-md-4 col-xl-3 mb-3">
                            <div id="<?php echo $evenementsId[$i]; ?>" class="card h-100" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">
                                <div class="card-header text-center">
                                    <h2 class="titreEvenement"><?php echo $evenementsNom[$i]; ?></h2>
                                    <span class="card-text fs-5"><?php echo $evenementsDate[$i]; ?></span>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-center p-0">
                                    <img class="card-img-bottom object-fit img-fluid" src="<?php echo $evenementsImage[$i]; ?>" alt="Image de l'évènement">
                                </div>
                                    <span class="card-lien d-none"><?php echo $evenementsLien[$i]; ?></span>
                                <?php
                                $evenementsIdTemp = $evenementsId[$i];
                                $sql = "SELECT d.nom FROM evenement_departement ed INNER JOIN departement d ON d.id = ed.id_departement WHERE ed.id_evenement=$evenementsIdTemp";
                                $resultProgramme = $conn->query($sql);
                    
                                while($rowProgramme = $resultProgramme->fetch_assoc()){
                                ?>
                                    <span class="card-departement d-none"><?php echo $rowProgramme['nom']; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            <?php
            //string de requête
            $sql = "SELECT * FROM evenement WHERE date<current_date() order by date desc";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            //  Afficher les évènements
            $evenementsId = [];
            $evenementsNom = [];
            $evenementsDate = [];
            $evenementsImage = [];
            $evenementsLien = [];
            $i=0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $evenementsId[$i] = $row['id'];
                    $evenementsNom[$i] = $row['nom'];
                    $evenementsDate[$i] = $row['date'];
                    $evenementsImage[$i] = $row['image'];
                    $evenementsLien[$i] = $row['lien'];
                    $i++;
                }
            ?>
                <h1>Vos évènements passés</h1>
            <?php
            }
            ?>
                <ul class="row g-3 m-0 w-100 justify-content-center">
                    <?php
                    for($i=0 ; $i<count($evenementsId) ; $i++){

                    ?>
                        <li class="col-sm-6 col-md-4 col-xl-3 mb-3">
                            <div id="<?php echo $evenementsId[$i]; ?>" class="card h-100" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">
                                <div class="card-header text-center">
                                    <h2 class="titreEvenement"><?php echo $evenementsNom[$i]; ?></h2>
                                    <span class="card-text fs-5"><?php echo $evenementsDate[$i]; ?></span>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-center p-0">
                                    <img class="card-img-bottom object-fit img-fluid" src="<?php echo $evenementsImage[$i]; ?>" alt="Image de l'évènement">
                                </div>
                                    <span class="card-lien d-none"><?php echo $evenementsLien[$i]; ?></span>
                                <?php
                                $evenementsIdTemp = $evenementsId[$i];
                                $sql = "SELECT d.nom FROM evenement_departement ed INNER JOIN departement d ON d.id = ed.id_departement WHERE ed.id_evenement=$evenementsIdTemp";
                                $resultProgramme = $conn->query($sql);
                    
                                while($rowProgramme = $resultProgramme->fetch_assoc()){
                                ?>
                                    <span class="card-departement d-none"><?php echo $rowProgramme['nom']; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
        <?php
        } else {
            mysqli_close($conn);
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
                        <p class="card-text text-center fs-3"></p>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                        <h3 class="text-center bg-white w-100 py-2">Les programmes invités :</h3>
                        <div class="card-departement d-flex flex-row w-100 flex-wrap justify-content-center"></div>
                        <img src="" class="card-img-bottom object-fit img-fluid" alt="Image de l'évènement">
                    </div>
                    <div class="card-footer d-flex flex-row justify-content-center p-0">
                        <a id="btnChoixSondage" class="btn btn-ctr-bleu w-100 p-3 border-end" href="choixSondage.php">
                            Débuter
                        </a>
                        <a id="btnStatistique" class="btn btn-ctr-bleu rounded-0 w-100 p-3 border-end" href="#">
                            Statistiques
                        </a>
                        <a id="btnGerer" class="btn btn-ctr-bleu rounded-0 w-100 p-3 border-end" href="modifier.php">
                            Modifier
                        </a>
                        <a id="btnWeb" class="btn btn-ctr-bleu rounded-0 w-100 p-3" href="#">
                            Site Web
                        </a>
                        <a id="btnSupp" class="w-100" href="modifier.php">
                            <form action="validation.php" class="h-100" method="get" onSubmit="return confirm('Êtes-vous sûrs de vouloir supprimer cet évènement?');">
                                <input id="inputId" type="hidden" name="id" value="">
                                <input id="destination" type="hidden" name="destination" value="supprimer">
                                <button id="confirmSupp" type="submit" class="btn btn-danger w-100 h-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 radius-0" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg>
                                </button>
                            </form>
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