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
    <title>Se connecter</title>  
     
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Script  -->
    <script src="js/connexion.js"></script>

</head>

<body>
    <main >

        <?php
        //Variables d'erreurs vides
        $usagerErreur = "";
        $mdpErreur = "";
        //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

            //Vérication champs connexion 
            if (empty($_POST['usager'])) {
                $usagerErreur = "Veuillez entrer votre usager";
                $erreur = true;
            } else
                $email = test_input($_POST['usager']);
            if (empty($_POST['mdp'])) {
                $mdpErreur = "Veuillez entrer votre mot de passe";
                $erreur = true;
            } else
                $password = test_input($_POST['mdp']);

            $user = $_POST['usager'];
            $password = $_POST['mdp'];

            $password = sha1($password, false);

            //Vérification si les identifiants sont dans la base de données
            $sql = "SELECT * from utilisateur where usager ='$user' AND mot_de_passe='$password'";
            echo $sql;
            $result = $conn->query($sql);

            if (isset($result)) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["connexion"] = true;
                    header("Location: index.php");
                } else {
                    echo "<p> Nom d'usager ou mot de passe invalide</p>";
                    $erreur = true;
                }
            }
            $conn->close();
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
                                            <h1>Se connecter</h1>
                                        </div>

                                        <!-- Usager -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="usager1" type="text" class="form-control mb-4 " name="usager" placeholder="Usager">
                                            <span id="usagerVide" class="text-danger"><?php echo $usagerErreur; ?></span>
                                        </div>

                                        <!-- Mot de passe -->
                                        <div class="form-outline form-white mb-4">
                                            <input id="mdp1" type="password" class="form-control mb-4" name="mdp" placeholder="Mot de passe">
                                            <span id="mdpVide" class="text-danger"><?php echo $mdpErreur; ?></span>
                                        </div>

                                        <!-- Se connecter submit -->
                                        <input class="btn btn-outline-light justify-content-center text-center mt-4 pt-1" type="submit" value="Se connecter">
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