<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
    ?>
        <div class="container-fluid d-flex flex-column justify-content-between vh-100 p-0">
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
            <?php
            //variable vide
            $destination = "";
            $id = "";
            //Variables d'erreurs vides
            $nipVide = "";
            $nipErreur = "";
            //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
            $erreur = false;

            if (isset($_GET['destination'])) {
                $destination = test_input($_GET['destination']);
            } else if (isset($_POST['destination'])) {
                $destination = test_input($_POST['destination']);
            }

            if (isset($_GET['id'])) {
                $id = test_input($_GET['id']);
            } else if (isset($_POST['id'])) {
                $id = test_input($_POST['id']);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (empty($_POST['nip'])) {
                    $nipVide = "Veuillez entrer un NIP";
                    $erreur = true;
                } else {
                    $nip = test_input($_POST['nip']);
                    if ($id == "") {
                        $URL = $destination . ".php";
                    } else {
                        $URL = $destination . ".php?id=" . $id;
                    }

                    if ($nip == "1234") {
                        echo $URL;
                        header("Location: " . $URL);
                    } else {
                        $nipErreur = "Mauvais NIP";
                        $erreur = true;
                    }
                }
            }

            if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
                if ($destination != "") {
            ?>
                    <div class="container-fluid  m-0 p-0">
                        <div class="container h-75">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                    <div class="card bg-ctr-bleu radius-1rem text-white">
                                        <div class="card-body p-5 text-center">
                                            <div class="mt-md-4 pb-5">
                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                    <div class="col text-center mb-5">
                                                        <h1>Entrer le NIP</h1>
                                                    </div>

                                                    <!-- NIP -->
                                                    <div class="form-outline form-white mb-4">
                                                        <input id="nip" type="text" class="form-control text-center mb-4" name="nip" maxlength="4">
                                                        <span id="nipVide" class="text-danger"><?php echo $nipVide; ?></span>
                                                        <input id="destination" type="hidden" class="form-control" name="destination" value="<?php echo $destination ?>">
                                                        <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                                    </div>

                                                    <!-- Message erreur NIP invalide -->
                                                    <div>
                                                        <span class="text-danger">
                                                            <?php echo $nipErreur; ?>
                                                        </span>
                                                    </div>
                                                    <!-- Se connecter submit et Créer un usager -->
                                                    <input id="btnValide" class="btn btn-outline-light text-center mt-4 pt-1" type="submit" value="Valider">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
<?php
                } else {
                    header("Location: ./index.php");
                }
            }
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/validation.js"></script>
</body>

</html>