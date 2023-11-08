<?php
require_once("library.php");
require_once("accesDB.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Unite</title>
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
                    <li class="active"><a href="pageUnite.php">A propos</a></li>
                    <li><a href="pageProjet.php">Projets</a></li>
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

                //-> Accès DB <--------------------------------------------------------------------------------------------------------------------------------------------

                connexionDB($connecte);

                $valeurIdUnite =  $_GET['idUnite'];


                $monFichier = fopen("uniteFile.txt", "w") or die("Error impossible d'ouvrir le fichier!");

                //-> Détaillé info unité <--------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT id, nomUnite, description 
                            FROM unite 
                            WHERE id='$valeurIdUnite'";

                    $result = $connecte->query($sql);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        $txt = "(Code : " . $row['id'] . ")" . "\n" .
                            strip_tags($row['nomUnite']) . " \n" .
                            strip_tags($row['description']) . " \n";

                        echo $txt;
                        fwrite($monFichier, $txt);
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //-> Responsable de l'unité <-------------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT c.id as numChercheur, c.nom, c.prenom, pc.idProjet
                            FROM uchercheur uc, chercheur c, uprojet up, pchercheur pc
                            WHERE pc.resp='responsable' 
                            
                                AND pc.idChercheur=c.id /* pour le nom prénom */

                                AND pc.idProjet=up.idProjet

                                AND up.idUnite = '$valeurIdUnite'

                    GROUP BY c.id, c.nom, c.prenom ";


                    $result = $connecte->query($sql);

                    $cptResponsable = $result->rowCount();

                    if ($cptResponsable == 1) {
                        echo "<p> Le Responsable : <p>";
                    } else {
                        echo "<p> Les Responsables : <p>";
                    }

                    //print_r($result->fetch(PDO::FETCH_ASSOC));

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<a href=pageChercheur.php?idChercheur=" . $row['numChercheur'] . "&idUnite=" . $valeurIdUnite . "&idProjet=" . $row['idProjet'] . ">" .
                            $row['nom'] . " " . $row['prenom'] . " </a>" . " \n";

                        fwrite($monFichier, $row['numChercheur']);

                        fwrite($monFichier, $valeurIdUnite);
                        fwrite($monFichier, $row['idProjet']);
                        echo "\n";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //-> les projets <----------------------------------------------------------------------------------------------------------------------------------------- 

                if ($connecte) {
                    $sql = "SELECT p.id, p.nomProjet 
                            FROM projet p, uprojet up 
                            WHERE p.id=up.idProjet 

                                AND up.idUnite='$valeurIdUnite'";


                    $result = $connecte->query($sql);

                    $cptprojets = $result->rowCount();

                    if ($cptprojets == 1) {
                        echo "<p> Le projet : <p>";
                    } else {
                        echo "<p> Les projets : <p>";
                    }


                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<a href=pageProjet.php?idProjet=" . $row["id"] . "&idUnite=" . $valeurIdUnite . ">" .

                            $row['nomProjet']  . "<br></a>";


                        fwrite($monFichier, $row["id"]);
                        fwrite($monFichier, $valeurIdUnite);
                        echo "\n";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                /*"SELECT distinct c.id as numChercheur, c.nom, c.prenom, pc.idProjet
                            FROM uchercheur uc, chercheur c, uprojet up, pchercheur pc
                            WHERE pc.resp='responsable' 
                            
                                AND pc.idChercheur=c.id //pour le nom prénom 

                                AND pc.idProjet=up.idProjet

                                AND up.idUnite = '$valeurIdUnite' ";*/


                //->les chercheurs qui y travailles <--------------------------------------------------------------------------------------------------------------------- 

                if ($connecte) {

                    $sql = "SELECT c.id as numchercheur, c.nom , c.prenom, pc.idProjet
                            FROM uchercheur uc, chercheur c, uprojet up, pchercheur pc
                            WHERE pc.resp=''
                                
                                And uc.idChercheur = c.id /*pour avoir le nom et prénom */

                                And up.idProjet = pc.idProjet /*pour avoir le projet auquel il appartient*/

                                AND uc.idUnite = '$valeurIdUnite'/*pour avoir l'unité auquel il appartient*/
                                
                            GROUP BY c.id, c.nom, c.prenom ";

                    $result = $connecte->query($sql);

                    $cptChercheurs = $result->rowCount();

                    if ($cptChercheurs == 1) {
                        echo "<p> Le chercheur : <p>";
                    } else {
                        echo "<p> Les chercheurs : <p>";
                    }


                    // echo "<a href=pageChercheur.php?idChercheur=" . $row['numChercheur'] . "&idUnite=" . $valeurIdUnite . "&idProjet=" . $row['idProjet'] . ">" .
                    //     $row['nom'] . " " . $row['prenom'] . " </a>" . " \n";



                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo  "<a href=pageChercheur.php?idChercheur=" . $row['numchercheur']  . "&idUnite=" . $valeurIdUnite . "&idProjet=" . $row['idProjet'] . ">" .
                            $row['nom'] . " " . $row['prenom'] . "<br> </a>";


                        fwrite($monFichier, $row['numchercheur']);
                        fwrite($monFichier, $valeurIdUnite);
                        echo "\n";
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }



                echo "<br> <a href=uniteFile.txt><button>Enregistrer la page</button></a>";

                fclose($monFichier);




                /*$destinataire = 'monclient@yopmail.com';
                $sujet = '-20% sur les stylos';
                $body = 'Bonjour! ' . "nn " . 'Venez acheter des stylos chez VendeuxDeStylo, des réduction à plus de -20 pour vous !';
                mail($destinataire, $sujet, $body);*/

                echo "<br> <a href=newfile.txt><button>Envoyer un mail</button></a>";

                echo "<br> <a href=index.php><button>retour menu</button></a>";



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