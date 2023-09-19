<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix Sondage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        if (isset($_GET['id'])) {
            $id = test_input($_GET['id']);
        }

    ?>
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <div class="container-fluid bg-ctr-bleu radius-1rem text-white text-center p-5">
                <div class="row mb-5">
                    <div class="col">
                        <h1>À qui donnerez-vous cette tablette?</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="satisfactionEtudiant.php?id=<?php echo $id; ?>" class="btn btn-outline-light fw-bold fs-3 m-4 pt-1">Étudiant</a>
                        <a href="satisfactionEmployeur.php?id=<?php echo $id; ?>" class="btn btn-outline-light fw-bold fs-3 m-4 pt-1">Employeur</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
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
</body>

</html>