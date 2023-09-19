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
    <title>Statistiques</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="index.php">
                                <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                            </a>
                        </li>
                        <li class="nav-item">
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="ajouter.php">Créer un évenement</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="deconnexion.php">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    </header>
    <main class="container">

        <?php
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
        // Set session variables
        $_SESSION["connexion"] = true;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        //string de requête
        $sql = "SELECT etudiantSatisfait,etudiantNeutre,etudiantInsatisfait FROM evenement where id=$id";
        $conn->query('SET NAMES utf8');

        //L'action la query est ici
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>
            <span id="nbEtudSatisf" class="visually-hidden"><?php echo $row['etudiantSatisfait'] ?></span>
            <span id="nbEtudNeutre" class="visually-hidden"><?php echo $row['etudiantNeutre'] ?></span>
            <span id="nbEtudInsatisf" class="visually-hidden"><?php echo $row['etudiantInsatisfait'] ?></span>
        <?php
        }
        ?>
        <canvas id="myChart">

        </canvas>
    </main>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/statistique.js"></script>
    <!-- Inclusion de la bibliothèque Chart.js -->
    <script  src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>