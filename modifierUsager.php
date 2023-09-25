<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création usager</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/creerUsager.js"></script>
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
                            <a class="btn btn-outline-light" href="ajouter.php">Créer un évènement</a>
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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * from utilisateur WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nomUsager =  $row['usager'];
            $mdp = $row['mot_de_passe'];
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "SELECT * from utilisateur WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nomUsager =  $row['usager'];
            $mdp = $row['mot_de_passe'];
        } else {
            echo "ERREUR";
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
            } elseif ($_POST['mdp'] != $_POST['confirmationMdp']) {
                $confirmationMdpErreur = "Les mots de passe ne sont pas identiques";
                $erreur = true;
            } else {
                $confirmationMdp = test_input($_POST["confirmationMdp"]);
                $confirmationMdp = sha1($password, false);
            }

            if ($erreur != true) {
                $sql = "UPDATE utilisateur SET usager='$nomUsager', mot_de_passe='$confirmationMdp'";
                $result = $conn->query($sql);

                //Regarder si le user est déjà dans la BD
                if (isset($result) && $result->num_rows > 0) {
                    $nomUsagerErreur = "Ce nom d'usager est déjà utilisé";
                    $erreur = true;
                } else {
                    $sql = "INSERT INTO utilisateur  (usager,mot_de_passe)VALUES ('" . $nomUsager . "','" . $confirmationMdp . "')";
                    if (mysqli_query($conn, $sql)) {
                        header("Location: connexion.php?action=modifierUsager");
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
                                <div class="md-5 mt-md-4 ">
                                    <form novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="col text-center mb-5">
                                            <h1>Modification de l'usager</h1>
                                        </div>

                                        <!-- Usager -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="usagerCreer" type="text" class="form-control mb-4 " name="usager" placeholder="Usager" value="<?php echo $nomUsager; ?>" required>
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
                                        <!-- Modifer-->
                                        <input class="btn btn-outline-light  text-center mt-4 pt-1" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
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
    <!-- Script personnalisé -->
    <script src="js/creerUsager.js"></script>
</body>

</html>