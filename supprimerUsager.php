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

//Récupère l'id
// $id = $_GET['id'];
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (!$conn) {
    die("Connectionfailed:" . mysqli_connect_error());
}

// $sql = "DELETE from utilisateur where id=$id";
if (isset($_SESSION['connexion'])) {

    if (isset($_POST['suppUtil'])) {
        $id = $_POST['supp_id'];
        $sql = "DELETE FROM utilisateur WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: listeUsager.php?action=supprimer");
        } else {
            echo "Erreur";
        }
    }
} else {
    header("Location: ./connexion.php");
}
?>