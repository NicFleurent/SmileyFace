<?php
//Démarre la session
session_start();
require("connexionServeur.php");
//require("connexionLocal.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>

    <!-- Bootstrap CSS et JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Scripts et css personnalisé  -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/connexion.js"></script>
    <script src="js/creerUsager.js"></script>
</head>

<body>
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
                    $_SESSION["serveur"] = true;
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
            <div class="container vh-100">
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

        ?>
        <!-- TOASTS -->
        <!-- Contenu du toast modification -->
        <article class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index: 10">
            <div id="toast-A" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <p class="me-auto"> Confirmation</p>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <p class="m-0">Votre utilisateur a été crée avec succès</p>
                </div>
            </div>
        </article> <!-- Fin toast -->

        <?php
       
        function test_input($data)
        {
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        ?>
    </main>

</body>

</html>