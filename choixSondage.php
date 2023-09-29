<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix Sondage</title>
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        if (isset($_GET['id'])) {
            $id = test_input($_GET['id']);
    ?>
            <div class="container-fluid vh-100 m-0 p-0">
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
                <div class="container d-flex flex-column justify-content-center align-items-center mt-5 h-75">
                    <div class="container-fluid bg-ctr-bleu radius-1rem text-white text-center p-5">
                        <div class="row mb-5">
                            <div class="col">
                                <h1>À qui donnerez-vous cette tablette?</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="satisfactionEtudiant.php?id=<?php echo $id; ?>" class="btn btn-outline-light fw-bold fs-3 m-4 pt-1">Étudiant</a>
                                <a href="satisfactionEmployeur.php?id=<?php echo $id; ?>" class="btn btn-outline-light fw-bold fs-3 m-4 pt-1">Employeur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        } else {
            header("Location: ./index.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</body>

</html>