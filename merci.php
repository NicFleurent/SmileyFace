<?php
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
    <title>Merci</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/merci.css">

    <link rel="icon" href="img_cegep_tr_logo.ico">

    <!--Source pour les confetti : https://www.youtube.com/watch?v=EHy0UNI1Abo-->
    <script src="js/confetti.js"></script>
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        if (isset($_GET['provenance']) && isset($_GET['id'])) {
            $provenance = test_input($_GET['provenance']);
            $id = test_input($_GET['id']);

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $conn->query('SET NAMES utf8');

            $sql = "SELECT * FROM evenement WHERE id=$id";
            $result = $conn->query($sql);

            if (!($result->num_rows > 0)) {
                mysqli_close($conn);
                header("Location: ./index.php");
            }
            mysqli_close($conn);

            if ($provenance == "etudiant") {
    ?>
                <div id="etudiant" class="d-none">satisfactionEtudiant.php?id=<?php echo $id; ?></div>
            <?php
            } else if ($provenance == "employeur") {
            ?>
                <div id="employeur" class="d-none">satisfactionEmployeur.php?id=<?php echo $id; ?></div>
            <?php
            } else {
            ?>
                <div id="erreur" class="d-none">Erreur</div>
            <?php
            }
            ?>
            <script id="confetti.js">
                startConfetti();
            </script>
            <div id="titre" class="container-fluid vh-100 d-flex justify-content-center align-items-center text-center">
                <div class="row">
                    <div class="col text-white">
                        <h1>Merci!!!</h1>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/merci.js"></script>
</body>

</html>