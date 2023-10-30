<?php
require_once("library.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ulb</title>

</head>

<body>

    <?php
    $servername = "localhost";
    $database = "ulb";

    $username = "root";
    $password = "";

    /*$servername = "localhost";
    $database = "id21452387_ulb";

    $username = "id21452387_suedy";
    $password = "Gedeon1996@";*/



    try {
        $connecte = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        // Définir le mode d'erreur PDO sur exception
        $connecte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connecté avec succès";
    } catch (PDOException $e) {
        echo "La connexion a échoué : " . $e->getMessage();
    }


    echo " <p>Bienvenu à l'ulb !</p>";


    afficheUnite($connecte);

    ?>


</body>

</html>