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
</head>

<body>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Vérification du usager
            if (empty($_POST['usager'])) {
                $nomErreur = "Veuillez entrer votre usager";
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
            }

            if ($erreur != true) {
                $sql = "INSERT INTO utilisateur  (usager,mot_de_passe)VALUES ('" . $_POST['nom'] . "','" . $_POST['confirmationMdp'] . "')";
                header("Location: connexion.php");
            } else {
                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
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
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="col text-center mb-5">
                                            <h1>Création de votre compte usager</h1>
                                        </div>

                                        <!-- Usager -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="usagerCreer" type="text" class="form-control mb-4 " name="usager" placeholder="Usager" value="">
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

                                        <!-- Message erreur mdp non identique -->
                                        <div>
                                            <span class="text-danger">

                                            </span>
                                        </div>
                                        <!-- Se connecter submit et Créer un usager -->
                                        <input class="btn btn-outline-light  text-center mt-4 pt-1" type="submit" value="Créer">
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
</body>

</html>