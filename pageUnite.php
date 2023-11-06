<?php
require_once("library.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Unite</title>

    <!-- Ajoutez les liens vers les fichiers Bootstrap CSS et JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</head>

<body>


    <?php


    $valeurIdUnite =  $_GET['idUnite'];

    //$valeurIdProjet =  $_GET['idProjet'];


    afficheDetailUnite($connecte, $valeurIdUnite);
    afficheChercheurResponsable($connecte, $valeurIdUnite);
    afficheProjet($connecte, $valeurIdUnite);
    afficheUchercheur($connecte, $valeurIdUnite);


    echo "<br> <a href=index.php><button>retour menu</button></a>";

    //"<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .

    // $fichier = fopen('test.txt', 'w');
    // $fwrite($fichier, gestTest)

    ?>





</body>

<footer>
    <p>
        ULB Université libre de bruxelles
    </p>

</footer>

</html>