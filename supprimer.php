<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="img_cegep_tr_logo.ico"> 
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        $id  = "";
        $idErreur = $erreurSQL = "";
        $erreur = false;

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "smileyface";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['id'])) {
            $id = test_input($_GET['id']);

            $sql = "DELETE FROM evenement_departement WHERE id_evenement=" . $id;
            if ($conn->query($sql) === TRUE) {
                echo "Succes : Supprimer de evenement_departement<br>";
            } else {
                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $erreur = true;
            }

            $sql = "DELETE FROM evenement WHERE id=" . $id;
            if ($conn->query($sql) === TRUE) {
                header("Location: ./index.php?succes=supprimer");
                die();
            } else {
                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $erreur = true;
            }
            $conn->close();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['id'])) {
                $idErreur = "Vous n'avez pas d'ID<br>";
                $erreur = true;
            }
            $id = test_input($_POST["id"]);

            if (!$erreur) {
                $sql = "DELETE FROM evenement_departement WHERE id_evenement=" . $id;
                if ($conn->query($sql) === TRUE) {
                    echo "Succes : Supprimer de evenement_departement<br>";
                } else {
                    $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $erreur = true;
                }

                $sql = "DELETE FROM evenement WHERE id=" . $id;
                if ($conn->query($sql) === TRUE) {
                    header("Location: ./index.php?succes=supprimer");
                    die();
                } else {
                    $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $erreur = true;
                }
                $conn->close();
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {

            echo $erreurSQL;
            echo $idErreur;
            if (!$erreur) {
    ?>
                <div>
                    Vous ne pouvez pas acceder directement à cette page
                </div>
    <?php
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
</body>

</html>