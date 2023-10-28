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
            <div class="container-fluid vh-100 d-flex flex-column justify-content-between p-0">
                    <header>
                        <nav class="navbar navbar-expand bg-body-tertiary mb-5">
                            <div class="container-fluid ">
                                <a class="ms-5" href="index.php">
                                    <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                                </a>
                                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center justify-content-end me-5">
                                    <li class="nav-item ms-5">
                                        <a class="btn btn-outline-light" href="validation.php?destination=ajouter">Créer un évènement</a>
                                    </li>
                                    <li class="nav-item ms-5">
                                        <a class="btn btn-outline-light" href="validation.php?destination=listeUsager">Utilisateurs</a>
                                    </li>
                                    <li class="nav-item ms-5">
                                        <a class="btn btn-outline-light" href="deconnexion.php">Déconnexion <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                            </svg></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                    <div class="container-fluid">
                        <div class="container bg-danger rounded p-5 mb-5 w-100">
                            <h3 class="m-3">Erreur - Vous ne pouvez pas supprimer un programme utilisé dans un évènement.</h1>
                            <h3 class="m-3">Vous devez retirer le programme de l'évènement ou supprimmer celui-ci.</h1>
                            <h3 class="m-3 mt-5">Voici la liste des évenements contenant ce programme : </h1>
                            
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