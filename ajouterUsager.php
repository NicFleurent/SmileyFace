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
    <title>Création usager</title>
    <link rel="icon" href="img_cegep_tr_logo.ico">
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
                            <a class="btn btn-outline-light" href="validation.php?destination=ajouter">Créer un évènement</a>
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
        if (isset($_SESSION['connexion'])) {
            //Variables du formulaire vide
            $nomUsager = "";
            $mdp = "";
            $confirmationMdp = "";

            //Variables d'erreurs vides
            $nomUsagerErreur = "";
            $mdpErreur = "";
            $confirmationMdpErreur = "";

            //La variable s'il y a une erreur
            $erreur = false;

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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Vérification du usager
                if (empty($_POST['usager'])) {
                    $nomUsagerErreur = "Veuillez entrer votre usager";
                    $erreur = true;
                } else
                    $nomUsager = test_input($_POST['usager']);
                //Vérification si les champs mdp sont vides et si les 2 sont identiques
                if (empty($_POST['mdp'])) {
                    $mdpErreur = "Veuillez entrer votre mot de passe";
                    $erreur = true;
                } else
                    $mdp = test_input($_POST['mdp']);

                if (empty($_POST['confirmationMdp'])) {
                    $confirmationMdpErreur = "Veuillez confirmer votre mot de passe";
                    $erreur = true;
                } else if ($_POST['mdp'] != $_POST['confirmationMdp']) {
                    $confirmationMdpErreur = "Les mots de passe ne sont pas identiques";
                    $erreur = true;
                } else {
                    $confirmationMdp = sha1($mdp, false);
                }

                if ($erreur != true) {
                    $sql = "SELECT usager from utilisateur where usager = '$nomUsager'";
                    $result = $conn->query($sql);

                    //Regarder si le user est déjà dans la BD
                    if (isset($result) && $result->num_rows > 0) {
                        $nomUsagerErreur = "Ce nom d'usager est déjà utilisé";
                        $erreur = true;
                    } else {
                        $sql = "INSERT INTO utilisateur  (usager,mot_de_passe)VALUES ('" . $nomUsager . "','" . $confirmationMdp . "')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: listeUsager.php?action=ajouterUsager");
                        } else {
                            echo "Error:" . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }

                mysqli_close($conn);
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
                                                <h1>Ajouter un utilisateur</h1>
                                            </div>

                                            <!-- Usager -->
                                            <div class="form-outline form-white mb-4">
                                                <input id="usagerCreer" type="text" class="form-control mb-4 " name="usager" placeholder="Usager" value="<?php $nomUsager; ?>" required>
                                                <span id="usagerCreerVide" class="text-danger"><?php echo $nomUsagerErreur; ?></span>
                                            </div>

                                            <!-- Mot de passe -->
                                            <div class="form-outline form-white mb-4">
                                                <input id="mdpCreer" type="password" class="form-control mb-4" name="mdp" placeholder="Mot de passe">
                                                <span id="mdpCreerVide" class="text-danger"><?php echo $mdpErreur; ?></span>
                                            </div>
                                            <!--Confirmation mdp -->
                                            <div class="form-outline form-white mb-4">
                                                <input id="mdpCreerConf" type="password" class="form-control mb-4" name="confirmationMdp" placeholder="Confirmation du mot de passe">
                                                <span id="mdpCreerConfVide" class="text-danger"><?php echo $confirmationMdpErreur; ?></span>
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
    </main>
    <!-- Bootstrap CSS et JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Script personnalisé -->
    <script src="js/ajouterUsager.js"></script>
    <!-- CSS peresonnalisé -->
    <link rel="stylesheet" href="css/styles.css">
</body>

</html>