<?php



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

function afficheChercheur($connecte)
{

    if ($connecte) {
        $sql = "SELECT id, nom, prenom, status FROM chercheur where status='responsable'";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des chercheur responsable: <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID : " . $row['id'] . ", 
                Nom : " . $row['nom'] . ", 
                Prénom : " . $row['prenom'] . ",
                Status : " . $row['status'] . "<br>";
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


function affichePchercheur($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT idChercheur, idProjet, resp FROM pchercheur ";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des pchercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "IdChercheur : " . $row['idChercheur'] . ", 
                  idProjet : " . $row['idProjet'] . ", 
                  Resp : " . $row['resp'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function afficheUprojet($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT idProjet, idUnite FROM uprojet";
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
        $sql = "SELECT idChercheur, idUnite, resp FROM uchercheur where idUnite='$valeurIdUnite'";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des uchercheurs : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "IdChercheur : " . $row['idChercheur'] . ", 
                  idUnite: " . $row['idUnite'] . ", 
                  Resp : " . $row['resp'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}
