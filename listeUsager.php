<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste utilisateurs</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/listeUsager.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid ">
                <div class="collapse navbar-collapse ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0  align-items-center">
                        <li class="nav-item">
                            <a href="index.php">
                                <img src="img/CTR_Logo_BLANC.png" alt="Logo CégepTR">
                            </a>
                        </li>
                        <li class="nav-item ms-5">
                            <form>
                                <input id="barreRecherche " class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                            </form>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="ajouter.php">Créer un évenement</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="listeUsager.php">Utilisateurs</a>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-outline-light" href="deconnexion.php">Déconnexion <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <?php
        if (isset($_SESSION['connexion'])) {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "smileyface";
            //Createconnection
            $conn = new mysqli($servername, $username, $password, $dbname);
            //Checkconnection
            if ($conn->connect_error) {
                die("Connectionfailed:" . $conn->connect_error);
            }
            // Set session variables
            $_SESSION["connexion"] = true;


            //string de requête
            $sql = "SELECT * FROM utilisateur ";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
        ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nom d'usager</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['id'] ?></th>
                                <td><?php echo $row['usager'] ?></td>
                                <td><a class="btn bg-ctr-bleu" href="modifierUsager.php?id=<?php echo $row['id'] ?>">Modifier</a></td>
                                <td><button id="confirmSupp" type="button" class="btn bg-ctr-bleu" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg></button></td>
                                <td> <a class="btn bg-ctr-bleu" href="ajouterUsager.php?id=<?php echo $row['id'] ?>">Ajouter un utilisateur</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>


            <?php

            } else {
                echo "0 results";
            }
            ?>
            <!-- TOASTS -->
            <!-- Contenu du toast groupe ajouté -->
            <article class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index: 10">
                <div id="toast-A" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <p class="me-auto"> Confirmation</p>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <p class="m-0">L'utilisateur a été ajouté</p>
                    </div>
                </div>
            </article><!-- Fin toast -->

            <!-- TOASTS -->
            <!-- Contenu du toast utilisateur modifié -->
            <article class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index: 10">
                <div id="toast-M" class="toast bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <p class="me-auto"> Confirmation</p>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <p class="m-0">L'utilisateur a été modifié</p>
                    </div>
                </div>
            </article>

            <?php

            //Appelle des fonctions toasts
            if (!isset($_GET['action'])) {
            } elseif ($_GET['action'] == "ajouterUsager") {
            ?>
                <script>
                    creerToastA()
                </script>

            <?php
            } elseif ($_GET['action'] == "modifierUsager") {
            ?>
                <script>
                    creerToastM()
                </script>

            <?php
            }
            ?>

            <!-- MODAL avertissement avant suppression -->
            <div class="modal fade modal-dialog modal-dialog-centered" id="modalSupp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalSuppLabel">Confirmation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment supprimer l'utilisateur <?php echo $row['usager'] ?> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-ctr-bleu" data-bs-dismiss="modal">Fermer</button>
                            <a class="btn bg-ctr-bleu" href="supprimerUsager.php?id=<?php echo $row['id'] ?>">Supprimer</a></td>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $conn->close();
        } else {
            header("Location: connexion.php");
        }
        ?>
    </main>
</body>

</html>