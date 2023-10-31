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
        $sql = "SELECT id, nom, prenom 
                FROM chercheur 
                where status='responsable'";

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

        echo "<p> Voici la liste détaillée des chercheur : <p>";


        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "Id : " . $row["id"] . ",
                Nom : " . $row['nom'] . ", 
                Prénom : " . $row['prenom'] . ",
                status : " . $row['status'] . "<br></a>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheProjet($connecte, $valeurIdUnite)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT p.id, p.nomProjet 
                FROM projet p, uprojet up 
                WHERE p.id=up.idProjet and up.idUnite='$valeurIdUnite'";

        /*"SELECT c.id, c.nom , c.prenom 
                FROM chercheur c, uchercheur u 
                where c.id = u.idChercheur and u.idUnite = '$valeurIdUnite'";*/


        $result = $connecte->query($sql);

        echo "<p> Voici la liste des projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=pageProjet.php?idProjet=" . $row["id"] . ">" .

                $row['nomProjet']  . "<br></a>";

            /* echo "<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .
                $row['nom'] . " " . $row['prenom'] . "<br> </a>";*/
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
                WHERE pc.idProjet='$valeurIdProjet'";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<a href=pageChercheur.php?idChercheur=" . $row['id'] . ">" .
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


function afficheUchercheur($connecte, $valeurIdUnite)
{


    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        // $sql = "SELECT idChercheur FROM uchercheur where idUnite='$valeurIdUnite'";
        $sql = "SELECT c.id, c.nom , c.prenom 
                FROM chercheur c, uchercheur u 
                where c.id = u.idChercheur and u.idUnite = '$valeurIdUnite'";

        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheurs : <p>";


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
