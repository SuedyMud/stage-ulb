<?php
require_once("library.php");
require_once("accesDB.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Projet</title>

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
                    <li class="active"><a href="pageProjet.php">Projets</a></li>
                    <li><a href="pageChercheur.php">Chercheurs</a></li>
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


                <?php

                //-> Accès DB <------------------------------------------------------------------------------------------------------------------------------------------

                //connexionDB($connecte);

                $valeurIdProjet =  $_GET['idProjet'];


                //-> Détaillé info projet <--------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT *
                            FROM projet
                            WHERE id='$valeurIdProjet'";

                    $result = $connecte->query($sql);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo  $row['id'] . "<br> \n" .
                            $row['nomProjet'] . "<br> \n " .
                            date('d/m/Y', strtotime($row['dateDebut'])) . " - " .
                            date('d/m/Y', strtotime($row['dateFin'])) . "<br> <br>" .
                            "Description : <br> \n " . $row['description'] . "<br><br> \n";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //-> Réponsable du projet <-------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT c.id as numChercheur, c.nom, c.prenom, pc.idProjet as numProjet, uc.idunite as numUnite
                            FROM pchercheur pc, chercheur c, uprojet up, uchercheur uc  
                            WHERE pc.resp='responsable' 
                            
                                AND pc.idChercheur=c.id 
                            
                                AND pc.idProjet= '$valeurIdProjet'

                                AND uc.idUnite =up.idUnite

                            GROUP BY c.id, c.nom, c.prenom ";


                    $result = $connecte->query($sql);

                    $cptResponsable = $result->rowCount();

                    if ($cptResponsable == 1) {
                        echo "<p> Le Responsable : <p>";
                    } else {
                        echo "<p> Les Responsables : <p>";
                    }

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo "<a href=pageChercheur.php?idChercheur=" . $row['numChercheur'] .  "&idProjet=" . $valeurIdProjet  . "&idUnite=" . $row['numUnite']  .  ">" .
                            $row['nom'] . " " . $row['prenom'] . "<br> </a>";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //-> Les chercheurs participant au projet) <-----------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT c.id as numChercheur, c.nom, c.prenom
                            FROM pchercheur pc, chercheur c
                            WHERE pc.resp =''
                            
                                AND pc.idChercheur=c.id 

                                AND pc.idProjet='$valeurIdProjet'
                            
                            GROUP BY c.id, c.nom, c.prenom";

                    $result = $connecte->query($sql);

                    $cptChercheurs = $result->rowCount();

                    if ($cptChercheurs == 1) {
                        echo "<p> Le chercheur : <p>";
                    } else {
                        echo "<p> Les chercheurs : <p>";
                    }

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo "<a href=pageChercheur.php?idChercheur=" . $row['numChercheur'] . "&idProjet=" . ">" .
                            $row['nom'] . " " . $row['prenom'] . "<br> </a>";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //--> Chercheurs appartenant à une unité <--------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT  u.id as numChercheur, u.nomUnite
                            FROM unite u, uprojet up               
                            WHERE u.id= up.idUnite 

                                    AND up.idProjet='$valeurIdProjet'

                            GROUP BY u.nomUnite";


                    $result = $connecte->query($sql);

                    $cptUnite = $result->rowCount();

                    if ($cptUnite == 1) {
                        echo "<p> Appartient à l'unité : <p>";
                    } else {
                        echo "<p> Appartient aux unités : <p>";
                    }


                    // Traitez les résultats ici, par exemple :
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo "<a href=pageUnite.php?idUnite=" . $row['numChercheur'] . ">" .
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


</body>

<footer class="container-fluid text-center">

    <p>
        ULB Université libre de bruxelles
    </p>

</footer>

</html>