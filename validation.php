<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main>
    <?php
    if ($_SESSION['connexion'] == true) {
        //variable vide
        $destination = "";
        $id = "";
        //Variables d'erreurs vides
        $nipVide = "";
        $nipErreur = "";
        //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
        $erreur = false;

        if(isset($_GET['destination'])){
            $destination = $_GET['destination'];
        }
        else if(isset($_POST['destination'])){
            $destination = $_POST['destination'];
        }

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        else if(isset($_POST['id'])){
            $id = $_POST['id'];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if(empty($_POST['nip'])){
                $nipVide = "Veuillez entrer un NIP";
                $erreur = true;
            }
            else{
                $nip = $_POST['nip'];
                if($id == ""){
                    $URL = $destination . ".php";
                }
                else{
                    $URL = $destination.".php?id=".$id;
                }

                if($nip == "1234"){
                    echo $URL;
                    header("Location: " . $URL);
                }
                else{
                    $nipErreur = "Mauvais NIP";
                    $erreur = true;
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            if($destination != ""){
    ?>
        <div class="container vh-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-ctr-bleu radius-1rem text-white">
                        <div class="card-body p-5 text-center">
                            <div class="mt-md-4 pb-5">

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="col text-center mb-5">
                                        <h1>Entrer le NIP</h1>
                                    </div>

                                    <!-- NIP -->
                                    <div class="form-outline form-white mb-4">
                                        <input id="nip" type="text" class="form-control text-center mb-4" name="nip" maxlength="4">
                                        <span id="nipVide" class="text-danger"><?php echo $nipVide; ?></span>
                                        <input id="destination" type="hidden" class="form-control" name="destination" value="<?php echo $destination ?>">
                                        <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                    </div>

                                    <!-- Message erreur NIP invalide -->
                                    <div>
                                        <span class="text-danger">
                                            <?php echo $nipErreur; ?>
                                        </span>
                                    </div>
                                    <!-- Se connecter submit et Créer un usager -->
                                    <input id="btnValide" class="btn btn-outline-light text-center mt-4 pt-1" type="submit" value="Valider">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                } else{
                    header("Location: ./index.php");
                }
            }
        } else {
            header("Location: ./connexion.php");
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="js/validation.js"></script>
</body>
</html>