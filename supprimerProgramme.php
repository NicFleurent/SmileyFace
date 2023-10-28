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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur suppression</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>
<body>
    
<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (!$conn) {
    die("Connectionfailed:" . mysqli_connect_error());
}
$conn->query('SET NAMES utf8');

// $sql = "DELETE from utilisateur where id=$id";
if (isset($_SESSION['connexion'])) {

    if (isset($_POST['suppProg'])) {
        $id = test_input($_POST['supp_id']);
        $sql = "DELETE FROM departement WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: listeProgramme.php?action=supprimerProgramme");
        } else {
            $erreurSupp = "Erreur - Vous ne pouvez pas supprimer un programme utiliser dans un évènement. Vous devez retirer le programme de l'évènement ou supprimmer celui-ci. Voici la liste des évenements contenant se programme : <br>";
            $sql = "SELECT * FROM evenement_departement WHERE id_departement=$id";
            $evenementsId = [];
            $i = 0;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $evenementsId[$i] = $row['id_evenement'];
                    $i++;
                }
            }
            ?>
            <div class="container bg-danger rounded p-5 m-5">
                <h3 class="m-3">Erreur - Vous ne pouvez pas supprimer un programme utiliser dans un évènement.</h1>
                <h3 class="m-3">Vous devez retirer le programme de l'évènement ou supprimmer celui-ci.</h1>
                <h3 class="m-3 mt-5">Voici la liste des évenements contenant se programme : </h1>
                
            <?php
            foreach($evenementsId as $event){
                $sql = "SELECT * FROM evenement WHERE id='".$event."'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<h4 class=\"mx-3\">Nom: ".$row['nom']." - Date: ".$row['date']."</h4>";
                }
            }
            ?>
            </div>
            <div class="text-center mt-3">
                <a class="btn btn-outline-dark mb-3 fs-4" href="index.php">Retour à la liste des évènements</a>
                <a class="btn btn-outline-dark mb-3 ms-3 fs-4" href="listeProgramme.php">Retour à la liste des programmes</a>
            </div>
            <?php
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>