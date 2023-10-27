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
    <title>Création Programme</title>

    <!-- Bootstrap CSS et JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS peresonnalisé -->
    <link rel="stylesheet" href="css/styles.css">

    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
        if (isset($_SESSION['connexion'])) {
    ?>
    <div class="container-fluid vh-100 d-flex flex-column justify-content-between p-0">
            <header>
                <nav class="navbar navbar-expand bg-body-tertiary mb-5">
                    <div class="container-fluid ">
                        <a class="ms-5" href="index.php">
                            <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                        </a>
                        <ul class="navbar-nav mb-2 mb-lg-0 align-items-center justify-content-end me-5">
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
                </nav>
            </header>
            <?php
                //Variables du formulaire vide
                $nomProgramme = "";

                //Variables d'erreurs vides
                $nomProgrammeErreur = "";

                //La variable s'il y a une erreur
                $erreur = false;

                //Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                //Check connection
                if (!$conn) {
                    die("Connectionfailed:" . mysqli_connect_error());
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    //Vérification du usager
                    if (empty($_POST['programme'])) {
                        $nomProgrammeErreur = "Veuillez entrer le nom du programme";
                        $erreur = true;
                    } else
                        $nomProgramme = test_input($_POST['programme']);

                    if ($erreur != true) {
                        $sql = "SELECT * from departement where nom = '$nomProgramme'";
                        $result = $conn->query($sql);

                        //Regarder si le user est déjà dans la BD
                        if (isset($result) && $result->num_rows > 0) {
                            $nomProgrammeErreur = "Ce programme existe déjà";
                            $erreur = true;
                        } else {
                            $sql = "INSERT INTO departement  (nom) VALUES ('" . $nomProgramme . "')";
                            if (mysqli_query($conn, $sql)) {
                                mysqli_close($conn);
                                header("Location: listeProgramme.php?action=ajouterProgramme");
                            } else {
                                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                }

                if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            ?>
                    <div class="container">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bg-ctr-bleu radius-1rem text-white">
                                    <div class="card-body p-5 text-center">
                                        <div class="md-5 mt-md-4 mb-3">

                                            <form novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                <div class="col text-center mb-5">
                                                    <h1>Ajouter un programme</h1>
                                                </div>
                                                <!-- Programme -->
                                                <div class="form-outline form-white mb-4">
                                                    <input id="programmeCreer" type="text" class="form-control mb-4 " name="programme" placeholder="Nom du programme" value="<?php echo $nomProgramme; ?>" required>
                                                    <span id="programmeCreerVide" class="text-danger"><?php echo $nomProgrammeErreur; ?></span>
                                                </div>

                                                <!--Ajouter -->
                                                <input class="btn btn-outline-light  text-center mt-4 pt-1" type="submit" value="Ajouter">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
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
    <?php
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
    <!-- Script personnalisé -->
    <script src="js/ajouterUsager.js"></script>
</body>

</html>