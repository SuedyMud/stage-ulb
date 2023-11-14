<?php

//-> Accès DB <------------------------------------------------------------------------------------------------------------------------------------------

// identifiant local ----------------------------------------
$servername = "localhost";
$database = "ulb";

$username = "root";
$password = "";


// identifiant Hébergeur -------------------------------------

//$servername = "localhost";
//$database = "id21452387_ulb";

//$username = "id21452387_suedy";
//$password = "Gedeon1996@";


try {
    $connecte = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Définir le mode d'erreur PDO sur exception
    $connecte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connecté avec succès";
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}
