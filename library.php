<?php

//configuration de la base de donnnée
$servername = "localhost";
$database = "ulb";

$username = "root";
$password = "";

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


function afficheUnite($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomUnite 
                FROM unite";

        $result = $connecte->query($sql);

        //echo "<p> Inventaire des unités <p>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageUnite.php?idUnite=" . $row["id"] . ">" .

                $row['nomUnite'] . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheDetailUnite($connecte, $valeurIdUnite)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomUnite, description 
                FROM unite 
                WHERE id='$valeurIdUnite'";

        $result = $connecte->query($sql);

        //echo "<p> Voici la liste détaillée des unités : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "(Code : " . $row['id'] . ")" . "<br> \n" .
                $row['nomUnite'] . "<br> \n" .
                $row['description'] . "<br> \n";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheChercheurResponsable($connecte, $valeurIdUnite)
{

    if ($connecte) {
        $sql = "SELECT c.id, c.nom, c.prenom 
                FROM chercheur c, uchercheur uc
                WHERE status='responsable' AND c.id=uc.idChercheur AND uc.idUnite = '$valeurIdUnite'";


        $result = $connecte->query($sql);

        /*echo "<br> \n" . "Responsable : " .
                "<a href=pageChercheur.php?idChercheur=" . $row['id'] . "&idProjet=" . $valeurIdProjet . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>" . "<br> \n";
        }*/


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo
            "<br> \n" . "Responsable de l'unité : " .  "<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>" . "<br> \n";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheChercheur($connecte)
{

    if ($connecte) {
        $sql = "SELECT id, nom, prenom 
                FROM chercheur
                WHERE status='responsable'";

        /*"SELECT c.id, c.nom , c.prenom 
                FROM chercheur c, uchercheur u 
                where c.id = u.idChercheur and u.idUnite = '$valeurIdUnite'";*/

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheur responsable: <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheDetailChercheur($connecte, $valeurIdChercheur)
{

    if ($connecte) {
        $sql = "SELECT id, nom, prenom, status 
                FROM chercheur
                WHERE id='$valeurIdChercheur'";

        $result = $connecte->query($sql);

        echo "<p> Données Personnelle du chercheur : <p>";


        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row["id"] . "<br> \n" .
                $row['nom'] . "<br> \n" .
                $row['prenom'] . "<br> \n" .
                $row['status'] . "<br> \n";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }

    $data = "les donné que vous voulez ajouter au fichier.";

    return $data;
}

function afficheProjet($connecte, $valeurIdUnite)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT p.id, p.nomProjet 
                FROM projet p, uprojet up 
                WHERE p.id=up.idProjet and up.idUnite='$valeurIdUnite'";


        $result = $connecte->query($sql);

        echo "<p> Les projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageProjet.php?idProjet=" . $row["id"] . ">" .

                $row['nomProjet']  . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheDetailProjet($connecte, $valeurIdUnite)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT *
                FROM projet
                WHERE id='$valeurIdUnite'";


        $result = $connecte->query($sql);

        //echo "<p> Voici la liste detaillée des projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo
            $row['id'] . "<br> \n" .
                $row['nomProjet'] . "<br> \n " .
                date('d/m/Y', strtotime($row['dateDebut'])) . " - " .
                date('d/m/Y', strtotime($row['dateFin'])) . "<br> \n " .
                "Description : <br> \n " . $row['description'] . "<br> \n";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function affichePchercheurResponsable($connecte, $valeurIdProjet)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT c.id, c.nom, c.prenom
                FROM pchercheur pc
                INNER JOIN chercheur c ON pc.idChercheur=c.id 
                WHERE pc.idProjet='$valeurIdProjet' AND pc.resp='responsable'";

        $result = $connecte->query($sql);

        //echo "<p> Voici la liste des chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<br> \n" . "Responsable : " .
                "<a href=pageChercheur.php?idChercheur=" . $row['id'] . "&idProjet=" . $valeurIdProjet . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>" . "<br> \n";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function affichePchercheur($connecte, $valeurIdProjet)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT c.id, c.nom, c.prenom
                FROM pchercheur pc
                INNER JOIN chercheur c ON pc.idChercheur=c.id 
                WHERE pc.idProjet='$valeurIdProjet' AND pc.resp =''";

        $result = $connecte->query($sql);

        echo "<p> Les chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<a href=pageChercheur.php?idChercheur=" . $row['id'] . "&idProjet=" . $valeurIdProjet . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheUprojet($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT idProjet, idUnite 
        FROM uprojet";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des uprojets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "IdProjet : " . $row['idProjet'] . ", 
                  IdUnite : " . $row['idUnite'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheUprojetAppartient($connecte, $valeurIdProjet)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT u.id, nomUnite
                FROM uprojet up, unite u
                where up.idProjet = '$valeurIdProjet' AND up.idUnite= id";

        $result = $connecte->query($sql);

        echo "<p> Ce projet appartient à l'unité : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //echo  $row['nom'] . " " . $row['prenom'] . "<br>";

            echo "<a href=pageUnite.php?idUnite=" . $row['id'] . ">" .
                $row['nomUnite'] . "<br> </a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheUchercheur($connecte, $valeurIdUnite)
{


    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        // $sql = "SELECT idChercheur FROM uchercheur where idUnite='$valeurIdUnite'";
        $sql = "SELECT c.id, c.nom , c.prenom 
                FROM chercheur c, uchercheur u 
                where c.id = u.idChercheur AND u.idUnite = '$valeurIdUnite' AND u.resp is NULL";

        $result = $connecte->query($sql);

        echo "<p> Les chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //echo  $row['nom'] . " " . $row['prenom'] . "<br>";

            echo "<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheUchercheurAppartient($connecte, $valeurIdUnite)
{


    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        // $sql = "SELECT idChercheur FROM uchercheur where idUnite='$valeurIdUnite'";

        /*SELECT pc.nomProjet
                FROM pchercheur pc
                INNER JOIN chercheur c ON pc.idProjet=c.id 
                WHERE pc.idChercheur='$valeurIdChercheur' AND pc.resp =''";*/

        $sql = "SELECT p.id
                FROM projet p,
                INNER JOIN pchercheur pc ON p.id = pc.'$valeurIdUnite' ";

        $result = $connecte->query($sql);

        echo "<p> Les chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //echo  $row['nom'] . " " . $row['prenom'] . "<br>";

            echo "<a href=pageUnite.php?idUnite=" . $row['idUnite'] . ">" .

                $row['idUnite'] . "<br> </a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}



/*
function afficheUnite($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomUnite, description FROM unite";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des unités : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageUnite.php?idUnite=" . $row["id"] . ">" .


                "Nom Unité : " . $row['nomUnite'] . ", 
                  
                  
                  Description : " . $row['description'] . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheProjet($connecte)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomProjet, dateDebut, dateFin, description FROM projet";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageProjet.php?idProjet=" . $row["id"] . ">" .

                "Nom : " . $row['nomProjet'] . ", 
                        Date Fin : " . $row['dateDebut'] . ",
                        Date Fin : " . $row['dateFin'] . ",
                        Description : " . $row['description'] . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

*/
