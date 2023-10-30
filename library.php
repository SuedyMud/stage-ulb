<?php



function afficheUnite($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id FROM unite";
        //$sql = "SELECT id FROM unite";
        //$sql = "SELECT id FROM unite";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des unités : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageUnite.php?idUnite=" . $row["id"] . ">" .


                "Unité : " . $row['id'] . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}

function afficheChercheur($connecte)
{

    if ($connecte) {
        $sql = "SELECT nom, prenom 
                FROM chercheur 
                where status='responsable'";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheur responsable: <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['nom'] . " " . $row['prenom'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheProjet($connecte)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id FROM projet";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageProjet.php?idProjet=" . $row["id"] . ">" .

                "Projet : " . $row['id']  . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function affichePchercheur($connecte, $valeurIdProjet)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT c.nom, c.prenom
                FROM pchercheur pc
                INNER JOIN chercheur c ON pc.idChercheur=c.id 
                WHERE pc.idProjet='$valeurIdProjet'";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des pchercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['nom'] . " " . $row['prenom'] . "<br>";

            //echo  $row['nom'] . " " . $row['prenom'] . "<br>";
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


function afficheUchercheur($connecte, $valeurIdUnite)
{


    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        // $sql = "SELECT idChercheur FROM uchercheur where idUnite='$valeurIdUnite'";
        $sql = "SELECT c.nom , c.prenom 
                FROM chercheur c, uchercheur u 
                where c.id = u.idChercheur and u.idUnite = '$valeurIdUnite'";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo  $row['nom'] . " " . $row['prenom'] . "<br>";
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
