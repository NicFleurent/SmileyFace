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

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <img src="img/CTR_Logo_BLANC.jpg" alt="Logo CégepTR">
                        </li>
                        <li class="nav-item">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Recherche</button>
                            </form>
                        </li>
                        <li class="nav-item ms-5">
                            <a class="btn btn-primary" href="ajouter.php">Créer un évenement</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
</body>

</html>