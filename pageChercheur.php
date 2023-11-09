<?php
require_once("library.php");
require_once("accesDB.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Chercheur</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">ULB</a></li>
                    <li><a href="pageUnite.php">Unites</a></li>
                    <li><a href="pageProjet.php">Projets</a></li>
                    <li class="active"><a href="pageChercheur.php">Chercheurs</a></li>
                    <li><a href="pageContact.php">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <!-- <p><a href="#">Link</a></p>
                <p><a href="#">Link</a></p>
                <p><a href="#">Link</a></p> -->
            </div>
            <div class="col-sm-8 text-left">
                <!-- <h1>Unité de recherche</h1> -->


                <?php

                //-> Accès DB <---------------------------------------------------------------------------------------------------------------------------------------

                //connexionDB($connecte);

                $valeurIdChercheur = $_GET['idChercheur'];
                $valeurIdProjet = $_GET['idProjet'];


                //--> affichage des informations détaillé du chercheur <------------------------------------------------------------------------------------------------

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


                //--> Appartient au projet <-------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT p.id as numProjet, p.nomProjet
                            FROM projet p, pchercheur pc 
                            WHERE p.id = pc.idProjet
                            
                                AND pc.idChercheur = '$valeurIdChercheur'";

                    $result = $connecte->query($sql);

                    echo "<p> Appartient au projet : <p>";


                    // Traitez les résultats ici, par exemple :
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo "<a href=pageProjet.php?idProjet=" . $row['numProjet'] . ">" .
                            $row['nomProjet'] . "<br> </a>";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }

                //--> Appartient à l'unité <-------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT u.id as numUnite, u.nomUnite
                            FROM unite u, uchercheur uc            
                            WHERE u.id=uc.idUnite

                                AND uc.idChercheur = '$valeurIdChercheur'";

                    $result = $connecte->query($sql);

                    echo "<p> Appartient à l'unité : <p>";


                    // Traitez les résultats ici, par exemple :
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo "<a href=pageUnite.php?idUnite=" . $row['numUnite'] . ">" .
                            $row['nomUnite'] . "<br> </a>";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                ?>

            </div>
            <div class="col-sm-2 sidenav">
                <!-- <div class="well">
                    <p>ADS</p>
                </div>
                <div class="well">
                    <p>ADS</p>
                </div> -->
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">

        <p>
            ULB Université libre de bruxelles
        </p>

    </footer>

</body>

</html>