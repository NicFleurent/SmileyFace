<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un évènement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
    if($_SESSION['connexion'] == true){
        $nom = $date = $lien = $departement = $image = "";
        $nomErreur = $dateErreur = $lienErreur = $departementErreur = $imageErreur = $erreurSQL = "";
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['nom'])) {
                $nomErreur = "Le nom est requis<br>";
                $erreur = true;
            }
            $nom = test_input($_POST["nom"]);

            if (empty($_POST['date'])) {
                $dateErreur = "La date est requise<br>";
                $erreur = true;
            }
            $date = test_input($_POST["date"]);

            if (empty($_POST['departement'])) {
                $departement = null;
            }
            $departement = test_input($_POST["departement"]);

            $lien = test_input($_POST["lien"]);
            if (empty($_POST['lien'])) {
                $lien = null;
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $lien)) {
                $lienErreur = "L'URL du lien n'est pas valide<br>";
                $erreur = true;
            }

            $image = test_input($_POST["image"]);
            if (empty($_POST['image'])) {
                $image = "img/CTR_Logo_RVB.jpg";
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $lien)) {
                $lienErreur = "L'URL de l'image n'est pas valide<br>";
                $erreur = true;
            }


            // Inserer dans la base de données
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "smileyface";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $conn->query('SET NAMES utf8');
            $sql = "INSERT INTO evenement (nom, date, lien, departement, image) 
            VALUES ('" . $nom . "', '" . $date . "', '" . $lien . "', '" . $departement . "', '" . $image . "')";
            if (mysqli_query($conn, $sql)) {
                header("Location: ./index.php?succes=ajouter");
                die();
            } else {
                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $erreur = true;
            }
            mysqli_close($conn);
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col text-white bg-danger">
                    <?php echo $erreurSQL; ?>
                </div>
            </div>
        </div>
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <div class="container-fluid bg-ctr-bleu radius-1rem text-white p-5">
                <h1 class="text-center mb-5">Ajouter un évènement</h1>
                <form id="form" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" placeholder="Nom de l'évènement" required>
                            <?php
                            if ($erreur == true) {
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
                            if ($erreur == true) {
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
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="departement" name="departement" value="<?php echo $departement; ?>" placeholder="Département">
                            <?php
                            if ($erreur == true) {
                            ?>
                                <div class="text-danger">
                                    <?php echo $departementErreur; ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>" placeholder="Lien vers une image représentant l'évènement">
                            <?php
                            if ($erreur == true) {
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
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lien" name="lien" value="<?php echo $lien; ?>" placeholder="Lien du site web de l'évènement">
                            <?php
                            if ($erreur == true) {
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
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-light fw-bold fs-3 mt-4 pt-1">Ajouter</button>
                    </div>
                </form>
            </div>
                <div class="text-center">
                    <a class="btn btn-outline-dark fw-bold fs-3 mt-2" href="./index.php" role="button">Retourner à la page d'accueil</a>
                </div>
        </div>
    <?php
        }
    }
    else{
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
    <script src="js/ajouter.js"></script>
</body>
</html>