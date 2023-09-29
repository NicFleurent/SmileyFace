<?php
//Démarre la session
session_start();
// require("connexionServeur.php");
require("connexionLocal.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <a href="index.php">
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
    <main>

        <?php
        //Variables vides
        $user = "";
        $mdp = "";
        //Variables d'erreurs vides
        $usagerErreur = "";
        $mdpErreur = "";
        $mauvaisIdentifiant = "";
        //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
        $erreur = false;


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            //Check connection
            if (!$conn) {
                die("Connectionfailed:" . mysqli_connect_error());
            }

            //Vérication champs connexion 
            if (empty($_POST['usager'])) {
                $usagerErreur = "Veuillez entrer votre usager";
                $erreur = true;
            } else
                $user = test_input($_POST['usager']);
            if (empty($_POST['mdp'])) {
                $mdpErreur = "Veuillez entrer votre mot de passe";
                $erreur = true;
            } else
                $mdp = test_input($_POST['mdp']);

            $mdp = sha1($mdp, false);

            //Vérification si les identifiants sont dans la base de données
            $sql = "SELECT * from utilisateur where usager ='$user' AND mot_de_passe='$mdp'";
            $result = $conn->query($sql);

            if (isset($result)) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["connexion"] = true;
                    $_SESSION["serveur"] = false;
                    header("Location: index.php");
                    echo "réussi";
                } else if ($_POST['usager'] != null && $_POST['mdp'] != null) {
                    $mauvaisIdentifiant = "Votre usager ou votre mot de passe est incorect";
                    $erreur = true;
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

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="col text-center mb-5">
                                            <h1>Se connecter</h1>
                                        </div>

                                        <!-- Usager -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="usager1" type="text" class="form-control mb-4 " name="usager" placeholder="Usager" value="<?php echo $user; ?>">
                                            <span id="usagerVide" class="text-danger"><?php echo $usagerErreur; ?></span>
                                        </div>

                                        <!-- Mot de passe -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="mdp1" type="password" class="form-control mb-4" name="mdp" placeholder="Mot de passe">
                                            <span id="mdpVide" class="text-danger"><?php echo $mdpErreur; ?></span>
                                        </div>

                                        <!-- Message erreur combinaison invalide -->
                                        <div>
                                            <span class="text-danger">
                                                <?php echo $mauvaisIdentifiant; ?>
                                            </span>
                                        </div>
                                        <!-- Se connecter submit et Créer un usager -->
                                        <input class="btn btn-outline-light  text-center mt-4 pt-1" type="submit" value="Se connecter">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        } // Fin if !=Post || erreur == true

        function test_input($data)
        {
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        ?>
    </main>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/connexion.js"></script>
</body>

</html>