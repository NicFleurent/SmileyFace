<?php
//Démarre la session
//session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évènements</title>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="index.php">
                                <img class="w-25" src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                            </a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                            </form>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="ajouter.php">Créer un évenement</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <h1>Vos évènements aujourd'hui</h1>
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
        //$_SESSION["connexion"] = true;

        //string de requête
        $sql = "SELECT * FROM evenement";
        $conn->query('SET NAMES utf8');

        //L'action la query est ici
        $result = $conn->query($sql);

        //  Afficher les évènements
        if ($result->num_rows > 0) {
        ?>
            <ul class="row g-3 m-0">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <li class="col-xl-4">
                        <div class="card h-100">
                            <img class="w-75" src="<?php echo $row['image'] ?>" class="card-img-top" alt="Image de l'évènement">
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title"><?php echo $row['nom'] ?></h2>
                                <p class="card-text"><?php echo $row['departement'] ?></p>
                                <div class="card-footer justify-content-center">
                                    <input id="<?php echo $row['id'] ?>" type="submit" value="Voir l'évènement">
                                    <!-- <button id="<?php echo $row['id'] ?>" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#evenement-offcanvas" aria-controls="offcanvasRight">Voir l'évènement</button> -->
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- OFF canvas-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="evenement-offcanvas" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h2>Votre évenement</h2>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="card h-100">
                                <img class="w-75" src="<?php echo $row['image'] ?>" class="card-img-top" alt="Image de l'évènement">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title"><?php echo $row['nom'] ?></h2>
                                    <p class="card-text"><?php echo $row['departement'] ?></p>
                                    <div class="card-footer justify-content-center">
                                        <a href="#">
                                            Débuter
                                        </a>
                                        <a href="#">
                                            Statistiques
                                        </a>
                                        <a href="#">
                                            Gérer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                    ?>
            </ul>
        <?php
        }
        ?>

    </main>
</body>

</html>