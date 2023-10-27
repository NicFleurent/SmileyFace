<?php
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
    <title>Sondage | Employeur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/satisfaction.css">
    <link rel="stylesheet" href="css/satisfactionEmployeur.css">
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        $erreur = false;

        if (isset($_GET['id'])) {
            $id = test_input($_GET['id']);
        }

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->query('SET NAMES utf8');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['id'])) {
                $idErreur = "Vous n'avez pas d'ID<br>";
                $erreur = true;
            }
            $id = test_input($_POST["id"]);

            if (empty($_POST['valeur'])) {
                $valeurErreur = "Vous n'avez pas de valeur<br>";
                $erreur = true;
            }
            $valeur = test_input($_POST["valeur"]);
            $sql = "SELECT $valeur FROM evenement WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nbrVote = $row["$valeur"];
            $nbrVote++;

            $sql = "UPDATE evenement SET $valeur='$nbrVote' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                header("Location: ./merci.php?provenance=employeur&id=$id");
                die();
            } else {
                $erreurSQL = "Error: $sql<br>" . mysqli_error($conn);
                $erreur = true;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            if ($id != "") {

            $sql = "SELECT * FROM evenement WHERE id=$id";
            $result = $conn->query($sql);

            if (!($result->num_rows > 0)) {
                mysqli_close($conn);
                header("Location: ./index.php");
            }
    ?>
                <div class="container-fluid d-flex flex-column justify-content-between align-items-center vh-100 p-0">
                    <div class="row">
                        <div class="col text-white mt-5">
                            <h1>Êtes-vous satisfait(e) de cet évènement?</h1>
                        </div>
                    </div>
                    <div class="row mx-5">
                        <div class="col-lg-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurSatisfait">
                                <button type="submit" class="btn p-0 m-3" id="btnSatisfait">
                                    <img class="img-fluid" src="img/satisfait-vote.png">
                                </button>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurNeutre">
                                <button type="submit" class="btn p-0 m-3" id="btnNeutre">
                                    <img class="img-fluid" src="img/neutre-vote2.png">
                                </button>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurInsatisfait">
                                <button type="submit" class="btn p-0 m-3" id="btnInsatisfait">
                                    <img class="img-fluid" src="img/insatisfait-vote.png">
                                </button>
                            </form>
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
                $conn->close();
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
</body>

</html>