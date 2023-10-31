<?php
require_once("library.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Chercheur</title>
</head>

<body>


    <?php
    //echo "PROJET  " . $_GET['idProjet'];

    $servername = "localhost";
    $database = "ulb";

    $username = "root";
    $password = "";

    $valeurIdChercheur =  $_GET['idChercheur'];

    try {
        $connecte = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        // Définir le mode d'erreur PDO sur exception
        $connecte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo " Connecté avec succès";
    } catch (PDOException $e) {
        echo "La connexion a échoué : " . $e->getMessage();
    }

    afficheDetailChercheur($connecte, $valeurIdChercheur);


    ?>





</body>

</html>