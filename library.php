<?php


function fUnite($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomUnite, description FROM unite";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des unités : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID : " . $row['id'] . ", 
                  Nom Unité : " . $row['nomUnite'] . ",  
                  Description : " . $row['description'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }

    /*
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
    }*/
}

function fChercheur($connecte)
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


function fProjet($connecte)
{
    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT id, nomProjet, dateDebut, dateFin, description FROM projet";
        $result = $connecte->query($sql);

        echo "<p> Voici la liste des projets : <p>";


        // Traitez les résultats ici, par exemple :
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID : " . $row['id'] . ", 
                        Nom : " . $row['nomProjet'] . ", 
                        Date Fin : " . $row['dateDebut'] . ",
                        Date Fin : " . $row['dateFin'] . ",
                        Description : " . $row['description'] . "<br>";
        }
    } else {
        echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
    }
}


function fPchercheur($connecte)
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


function fUprojet($connecte)
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


function fUchercheur($connecte)
{

    // vérification de la connexion est établie avant d'exécuter une requête SQL
    if ($connecte) {
        $sql = "SELECT idChercheur, idUnite, resp FROM uchercheur ";
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
