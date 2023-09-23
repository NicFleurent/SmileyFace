<?php
//Démarre la session
session_start();
?>

<?php
//Variables connexion
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smileyface";

//Récupère l'id
$id = $_GET['id'];
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (!$conn) {
    die("Connectionfailed:" . mysqli_connect_error());
}

$sql = "DELETE from utilisateur where id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Le groupe a été supprimé";
    header("Location: listeUsager.php?action=supprimer");
} else {
    echo "Erreur";
}

$conn->close();

?>