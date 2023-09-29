<?php
session_start();
if ($_SESSION['serveur']) {
    require("connexionServeur.php");
} else {
    require("connexionLocal.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste utilisateurs</title>
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
<header>
        <nav class="navbar navbar-expand bg-body-tertiary mb-5 fixed-top">
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
    <main class="container">
        <?php
        if (isset($_SESSION['connexion'])) {

            //Creer connexion
            $conn = new mysqli($servername, $username, $password, $dbname);
            //Vérifie la connexion
            if ($conn->connect_error) {
                die("Connectionfailed:" . $conn->connect_error);
            }

            //Affiche des messages de confirmation pour modifications ou ajout utilisateur
            if (isset($_GET['action'])) {
                if ($_GET['action'] === "ajouterUsager") {
        ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        L'utilisateur a bien été <strong>ajouté!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else if ($_GET['action'] === "modifierMdp") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        Le mot de passe a bien été <strong>modifié!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else if ($_GET['action'] === "modifierUsager") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        Le nom d'utlisateur a bien été <strong>modifié!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else if ($_GET['action'] === "supprimerUsager") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        L'utlisateur a bien été <strong>supprimé!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
            }
            //string de requête
            $sql = "SELECT * FROM utilisateur ";
            $conn->query('SET NAMES utf8');

            //L'action la query est ici
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                ?>
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nom d'usager</th>
                            <th scope="col" class="text-center">Modifications</th>
                            <th scope="col" class="text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="d-none"><?php echo $row['id'] ?></td>
                                <td><?php echo $row['usager'] ?></td>
                                <td class="text-center"><a class="btn btn-outline-dark" href="modifierUsager.php?id=<?php echo $row['id'] ?>">Nom d'usager</a>
                                    <a class="btn btn-outline-dark" href="modifierMdp.php?id=<?php echo $row['id'] ?>">Mot de passe</a>
                                </td>
                                <td class="text-center"><button type="button" class="btn btn-danger btn-supprimer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg></button></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Ajouter un utilisateur -->
                <a class="btn btn-outline-dark" href="ajouterUsager.php">Ajouter un utilisateur</a>
            <?php
            } else {
                echo "Il n'y aucun utilisateur d'enregistré";
            }
            mysqli_close($conn);

            ?>
            <!-- MODAL avertissement avant suppression -->
            <div class="modal fade" id="modalSupp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="supprimerUsager.php" method="POST">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalSuppLabel">Confirmer la suppression</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="supp_id" id="supp_id">
                                <p>Voulez-vous vraiment supprimer l'utilisateur ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="suppUtil" class="btn bg-ctr-bleu">Oui</button>
                                <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        } else {
            mysqli_close($conn);
            header("Location: ./connexion.php");
        }
        ?>
    </main>

    <footer class="text-center">
        <!-- Copyright -->
        <div class="d-flex">
            <p>
                © 2023 Copyright: Nicolas Fleurent & Mirolie Théroux
            </p>
            <img src="img/Logo_offic_2L_Techniques_informatique-01.png" alt="Logo tech">
        </div>
    </footer>
    <!-- Bootstrap CSS et JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/listeUsager.js"></script>


</body>

</html>