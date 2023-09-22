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
            
            //string de requête
            $sql = "SELECT etudiantSatisfait,etudiantNeutre,etudiantInsatisfait FROM evenement where id=$id";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            ?>
                    <span id="nbEtudSatisf" class="visually-hidden"> <?php echo $row['etudiantSatisfait'] ?></span>
                    <span id="nbEtudNeutre" class="visually-hidden"><?php echo $row['etudiantNeutre'] ?></span>
                    <span id="nbEtudInsatisf" class="visually-hidden"><?php echo $row['etudiantInsatisfait'] ?></span>

                <?php
                }
            }
            $sql = "SELECT employeurSatisfait,employeurNeutre,employeurInsatisfait FROM evenement where id=$id";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                ?>
                    <span id="nbEntSatisf" class="visually-hidden"><?php echo $row['employeurSatisfait'] ?></span>
                    <span id="nbEntNeutre" class="visually-hidden"><?php echo $row['employeurNeutre'] ?></span>
                    <span id="nbEntInsatisf" class="visually-hidden"><?php echo $row['employeurInsatisfait'] ?></span>
            <?php
                }
            }
        }
        else{
            header("Location: ./index.php");
        }

        ?>
        <!-- Pour avoir un bon comportement responsive, il faut ajouter les styles ci-dessous
             dans le conteneur du "canvas" -->

        <div class="d-flex justify-content-center ">
            <div class="me-5">
                <h1 id="titre-etu"></h1>
                <div class="position-relative">
                    <canvas id="canvas-diagramme"></canvas>
                </div>
            </div>
            <div class="ms-5">
                <h1 id="titre-ent"></h1>
                <div class="position-relative">
                    <canvas id="canvas-diagramme2"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/statistique.js"></script>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>

</html>