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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer l'évènement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
    ?>
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
                        <a class="btn btn-outline-light" href="deconnexion.php">
                            Déconnexion 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
        $id = $nom = $date = $lien = $departement = "";
        $idErreur = $nomErreur = $dateErreur = $lienErreur = $imageErreur = $erreurSQL = "";
        $erreurChant = $erreurBD = false;

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->query('SET NAMES utf8');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['id'])) {
                $idErreur = "Vous n'avez pas d'ID<br>";
                $erreurChant = true;
            }
            $id = test_input($_POST["id"]);

            if (empty($_POST['nom'])) {
                $nomErreur = "Le nom est requis<br>";
                $erreurChant = true;
            }
            $nom = test_input($_POST["nom"]);

            if (empty($_POST['date'])) {
                $dateErreur = "La date est requise<br>";
                $erreurChant = true;
            }
            $date = test_input($_POST["date"]);

            $lien = test_input($_POST["lien"]);
            if (empty($_POST['lien'])) {
                $lien = null;
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $lien)) {
                $lienErreur = "L'URL du lien n'est pas valide<br>";
                $erreurChant = true;
            }

            $image = test_input($_POST["image"]);
            if (empty($_POST['image'])) {
                $image = "img/CTR_Logo_RVB.jpg";
            } else if ((!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $image))) {
                $imageErreur = "L'URL de l'image n'est pas valide<br>";
                $erreurChant = true;
            }


            if (!$erreurChant) {
                $sql = "UPDATE evenement SET nom='" . $nom . "', date='" . $date . "', lien='" . $lien . "', image='" . $image . "' WHERE id=" . $id;
                if ($conn->query($sql) === TRUE) {
                    echo "Succes : Modification de l'évènement dans la BD<br>";
                } else {
                    $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $erreurBD = true;
                }

                $sql = "SELECT id FROM evenement WHERE nom='$nom' AND date='$date'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
                $idEvenement = $row["id"];

                $sql = "DELETE FROM evenement_departement WHERE id_evenement=" . $idEvenement;
                if ($conn->query($sql) === TRUE) {
                    echo "Succes : Supression des lignes surperflux dans la BD<br>";
                } else {
                    $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $erreurBD = true;
                }

                if (isset($_POST['departementLength'])) {
                    $departementLength = test_input($_POST['departementLength']);

                    for ($i = 0; $i < $departementLength; $i++) {
                        $departementTemp = "departement$i";
                        if (isset($_POST[$departementTemp])) {
                            $departement = test_input($_POST[$departementTemp]);

                            $sql = "SELECT id FROM departement WHERE nom='$departement'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            }
                            $idDepartement = $row["id"];

                            $sql = "INSERT INTO evenement_departement (id_evenement, id_departement) 
                            VALUES ('" . $idEvenement . "', '" . $idDepartement .  "')";

                            if (mysqli_query($conn, $sql)) {
                                echo "Succes : $idEvenement et $idDepartement<br>";
                            } else {
                                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                $erreurBD = true;
                            }
                        }
                    }
                }

                if (!$erreurBD) {
                    mysqli_close($conn);
                    header("Location: ./index.php?succes=modifier");
                    die();
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreurChant == true || $erreurDB == true) {

            if (isset($_GET['id'])) {
                $id = test_input($_GET['id']);
            }

            if ($id != "") {
                echo $idErreur;

                $sql = "SELECT * FROM evenement WHERE id=$id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }

                $nom = $row["nom"];
                $date = $row["date"];
                $lien = $row["lien"];
                if ($row["image"] == "img/CTR_Logo_RVB.jpg") {
                    $image = "";
                } else {
                    $image = $row["image"];
                }
    ?>
                <div class="container">
                    <div class="row">
                        <div class="col text-white bg-danger">
                            <?php echo $erreurSQL ?>
                        </div>
                    </div>
                </div>
                <div class="container d-flex flex-column justify-content-center align-items-center">
                    <div class="container-fluid bg-ctr-bleu radius-1rem text-white p-5 mb-5">
                        <h1 class="text-center mb-5">Modifier les informations</h1>
                        <form id="form" class="g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="row mb-4">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" placeholder="Nom de l'évènement" required>
                                    <?php
                                    if ($erreurChant == true) {
                                    ?>
                                        <div class="text-danger">
                                            <?php echo $nomErreur; ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="invalid-feedback" id="invalidNom">
                                            Le nom est requis
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <label for="date" class="col-sm-1 col-form-label text-end">Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" required>
                                    <?php
                                    if ($erreurChant == true) {
                                    ?>
                                        <div class="text-danger">
                                            <?php echo $dateErreur; ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="invalid-feedback" id="invalidDate">
                                            La date est requise
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>" placeholder="Lien vers une image représentant l'évènement">
                                    <?php
                                    if ($erreurChant == true) {
                                    ?>
                                        <div class="text-danger">
                                            <?php echo $imageErreur; ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="invalid-feedback" id="invalidImage">
                                            Le lien de l'image n'est pas valide
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lien" name="lien" value="<?php echo $lien; ?>" placeholder="Lien du site web de l'évènement">
                                    <?php
                                    if ($erreurChant == true) {
                                    ?>
                                        <div class="text-danger">
                                            <?php echo $lienErreur; ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="invalid-feedback" id="invalidLien">
                                            Le lien du site n'est pas valide
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div id="containerDepartement" class="container-fluid p-0 m-0">
                                <?php
                                $sql = "SELECT ed.id_departement, d.nom FROM evenement_departement ed INNER JOIN departement d ON d.id = ed.id_departement WHERE ed.id_evenement=$id";

                                $result = $conn->query($sql);

                                $programmeChoisis = [];
                                $i = 0;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $programmeChoisis[$i++] = $row['nom'];
                                    }
                                }
                                foreach ($programmeChoisis as $programmeChoisi) {
                                ?>
                                    <div class="row mb-4 original-row">
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="Default select example" name="departement0">
                                                <option selected><?php echo $programmeChoisi; ?></option>
                                
                                                <?php
                                                $sql = "SELECT nom FROM departement WHERE nom!='$programmeChoisi' ORDER BY nom";
                                                $resultProgramme = $conn->query($sql);

                                                while ($rowProgramme = $resultProgramme->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $rowProgramme['nom']; ?>"><?php echo $rowProgramme['nom']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 text-end d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-light btn-ajouterDept fw-bold">+</button>
                                            <button type="button" class="btn btn-outline-light btn-supprimerDept fw-bold">-</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="text-center">
                                <button id="btnEnvoyer" type="submit" class="btn btn-outline-light fw-bold fs-3 mt-4 pt-1">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>
    <?php
            } else {
                mysqli_close($conn);
                header("Location: ./index.php");
            }
        }
    } else {
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
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="js/modifier.js"></script>
</body>

</html>