<?php
require_once("library.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Unite</title>
</head>

<body>


    <?php
    //echo "UNITE  " . $_GET['idUnite'];

    $servername = "localhost";
    $database = "ulb";

    $username = "root";
    $password = "";

    $valeurIdUnite =  $_GET['idUnite'];



    try {
        $connecte = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        // Définir le mode d'erreur PDO sur exception
        $connecte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo " Connecté avec succès";
    } catch (PDOException $e) {
        echo "La connexion a échoué : " . $e->getMessage();
    }

    afficheChercheur($connecte);
    afficheProjet($connecte);
    afficheUchercheur($connecte, $valeurIdUnite);

    //echo "$valeurIdUnite";

    ?>





</body>

</html>