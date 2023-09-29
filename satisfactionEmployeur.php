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
    <link rel="stylesheet" href="css/satisfactionEmployeur.css">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        $erreur = false;
        if (isset($_GET['id'])) {
            $id = test_input($_GET['id']);
        }
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

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $conn->query('SET NAMES utf8');
            $sql = "SELECT $valeur FROM evenement WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nbrVote = $row["$valeur"];
            $nbrVote++;

            $sql = "UPDATE evenement SET $valeur='$nbrVote' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                header("Location: ./merci.php?provenance=employeur&id=$id");
                die();
            } else {
                $erreurSQL = "Error: $sql<br>" . mysqli_error($conn);
                $erreur = true;
            }
            $conn->close();
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            if ($id != "") {
    ?>
                <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
                    <div class="row">
                        <div class="col text-white mb-5">
                            <h1>Êtes-vous satisfait de cet évènement?</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurSatisfait">
                                <button type="submit" class="btn" id="btnSatisfait">
                                    <img class="img-fluid" src="img/voteSatisfait.png">
                                </button>
                            </form>
                        </div>

                        <div class="col-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurNeutre">
                                <button type="submit" class="btn" id="btnNeutre">
                                    <img class="img-fluid" src="img/voteNeutre.png">
                                </button>
                            </form>
                        </div>

                        <div class="col-4">
                            <form class="d-flex justify-content-center align-items-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="valeur" value="employeurInsatisfait">
                                <button type="submit" class="btn" id="btnInsatisfait">
                                    <img class="img-fluid" src="img/voteInsatisfait.png">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
    <?php
            } else {
                $conn->close();
                header("Location: ./index.php");
            }
        }
    } else {
        $conn->close();
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