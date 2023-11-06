<?php
require_once("library.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Chercheur</title>

    <!-- Ajoutez les liens vers les fichiers Bootstrap CSS et JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>


    <?php

    $valeurIdChercheur = $_GET['idChercheur'];
    $valeurIdProjet = $_GET['idProjet'];

    afficheDetailChercheur($connecte, $valeurIdChercheur);



    /*
    $fichier = fopen("chercheur.txt", "r");
    $premier = fget($fichier, 10);

    echo "Dix premier caractères : " . $premier;
    fclose($fichier)*/


    // if ($data) {
    //     // Créez un fichier texte et écrivez des données
    //     $filename = "chercheur.txt";
    //     file_put_contents($filename, $data);

    //     echo "<a href='$filename' download='chercheur.txt'><button>Télécharger</button></a>";
    // } else {
    //     echo "Aucune donnée à télécharger.";
    // }

    ?>

</body>

<footer>
    <p>
        ULB Université libre de bruxelles
    </p>

</footer>

</html>