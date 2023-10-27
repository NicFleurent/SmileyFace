<?php
//Démarre la session
session_start();
if($_SESSION['serveur']){
    require("connexionServeur.php");
}
else{
    require("connexionLocal.php");
}
?>

<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (!$conn) {
    die("Connectionfailed:" . mysqli_connect_error());
}

// $sql = "DELETE from utilisateur where id=$id";
if (isset($_SESSION['connexion'])) {

    if (isset($_POST['suppProg'])) {
        $id = test_input($_POST['supp_id']);
        $sql = "DELETE FROM departement WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: listeProgramme.php?action=supprimerProgramme");
        } else {
            echo "Erreur";
        }
    }
    else{
        $conn->close();
        header("Location: ./index.php");
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