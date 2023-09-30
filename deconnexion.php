<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="icon" href="img_cegep_tr_logo.ico">
</head>
<body>
<?php
// Supprimes toutes les variables
session_unset();
// Détruire la session
session_destroy();
header("Location: ./connexion.php");
?>
</body>
</html>