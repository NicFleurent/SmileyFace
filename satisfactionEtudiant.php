<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage | Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
    $erreur = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            echo "test";
            if(isset($_POST['satisfait'])){
                echo "satisfait";
            }
            elseif(isset($_POST['neutre'])){
                echo "neutre";
            }
            elseif(isset($_POST['insatisfait'])){
                echo "insatisfait";
            }
            else{
                echo "erreur";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            echo "1ere fois";
            
    ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row h-100">
            <form action="" class="d-flex justify-content-center align-items-center h-100" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="col-4">
                    <button type="submit" class="btn"  id="btnSatisfait">
                        <img class="img-fluid" src="img/voteSatisfait.png">
                    </button>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn" id="btnNeutre">
                        <img class="img-fluid" src="img/voteNeutre.png">
                    </button>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn" id="btnNeutre">
                        <img class="img-fluid" src="img/voteInsatisfait.png">  
                    </button>
                </div>
            </form>
            
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
</body>
</html>