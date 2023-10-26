<?php
require_once("library.php")
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

    fUnite($connecte);

    echo " <p>********** Menu ***********</p>";

    // Utilisez un formulaire HTML avec des boutons cliquables
    echo '<form method="post" action="">';
    echo ' <p>Sélectionnez une option :</p>';
    echo ' <input type="submit" name="choix" value="1"> Lister les responsables <br>';
    echo ' <input type="submit" name="choix" value="2"> Lister des projets <br>';
    echo ' <input type="submit" name="choix" value="3"> Lister des personnes travaillant dans cette unité <br>';
    echo ' <input type="submit" name="choix" value="4"> Quitter';
    echo '</form>';

    // Traitement de l'entrée de l'utilisateur après avoir soumis le formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $choix = $_POST['choix'];

        switch ($choix) {
            case 1:
                //echo " <p>Lister les responsable </p>";
                fChercheur($connecte);
                break;
            case 2:
                //echo " <p>Lister des projet</p>";
                fProjet($connecte);
                break;
            case 3:
                //echo " <p>Lister des personnes travaillant dans cette unité</p>";
                fUchercheur($connecte);
                break;
            default:
                echo " <p>fin.</p>";
        }
    }

    ?>


</body>

</html>