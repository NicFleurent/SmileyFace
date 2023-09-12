<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un évènement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
    //if($_SESSION['connexion'] == true){
        $nom = $date = $lien = $departement = "";
        $nomErreur = $dateErreur = $lienErreur = $departementErreur = $erreurSQL = "";
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

            $lien = test_input($_POST["lien"]);
            if (empty($_POST['lien'])) {
                $lienErreur = "Le lien est requis<br>";
                $erreur = true;
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $lien)) {
                $lienErreur = "L'URL n'est pas valide<br>";
                $erreur = true;
            }

            if (empty($_POST['departement'])) {
                $departementErreur = "Le departement est requis<br>";
                $erreur = true;
            }
            $departement = test_input($_POST["departement"]);


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

            $sql = "INSERT INTO evenement (nom, date, lien, departement) 
            VALUES ('" . $nom . "', '" . $date . "', '" . $lien . "', '" . $departement . "')";
            if (mysqli_query($conn, $sql)) {
                echo "Ça marche";
                //header("Location: ./index.php?succes=ajouter");
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
        <div class="container mt-3">
            <h1 class="text-center">Ajouter un évènement</h1>
            <form id="form" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <div class="row mb-3 mt-3">
                    <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nom" name="nom" value="" required>
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
                </div>
                <div class="row mb-3">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="" required>
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
                <div class="row mb-3">
                    <label for="lien" class="col-sm-2 col-form-label">Lien du site</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lien" name="lien" value="" required>
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
                                Le lien du site de l'évènement est requis
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="departement" class="col-sm-2 col-form-label">Département</label>
                    <div class="col-sm-10">
                        <input type="test" class="form-control" id="departement" name="departement" value="" required>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $departementErreur; ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="invalid-feedback" id="invalidDepartement">
                                Le département est requis
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
            <div class="text-center">
                <a class="btn btn-primary mt-2" href="./index.php" role="button">Retourner à la page d'accueil</a>
            </div>
        </div>
    <?php
        }
    //}
    else{
        //header("Location: ./connexion.php");
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