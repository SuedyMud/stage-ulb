<?php
require_once("accesDB.php");


// Récupération des identifiants d'unités depuis la base de données
$listeIdUnite = array();
if ($connecte) {
    $sql = "SELECT id, nomUnite  
            FROM unite";

    $result = $connecte->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $listeIdUnite[] = $row['id'];
    }
} else {
    echo "La connexion à la base de données a échoué.";
}

$listeIdProjet = array();
if ($connecte) {
    $sql = "SELECT id, nomProjet  
            FROM projet";

    $result = $connecte->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $listeIdProjet[] = $row['id'];
    }
} else {
    echo "La connexion à la base de données a échoué.";
}


$listeIdChercheur = array();
if ($connecte) {
    $sql = "SELECT id, nom, prenom 
            FROM chercheur";

    $result = $connecte->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $listeIdChercheur[] = $row['id'];
    }
} else {
    echo "La connexion à la base de données a échoué.";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ulb</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */

        /* les onglets en hauteur */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
            background-color: #22427C;
        }

        .active a {
            background-color: #03224C !important;
            /* Changez la couleur ici selon votre préférence */
        }


        .navbar-logo {
            position: absolute;
            bottom: 2px;
            /* left: 1px; */
            /* width: 50px; */

        }

        .navbar-logo img {
            width: 160px;
            /* Taille du logo */
        }


        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */

        /* menu unité de recherche */
        .row.content {
            height: 450px;

        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: white;
            height: 100%;
        }

        /* Set black background color, white text and some padding */

        footer {
            background-color: #03224C;
            color: white;
            padding: 30px;
        }

        footer-content {
            display: flex;
        }

        .footer-content p {
            position: absolute;
            bottom: 15px;
            left: 90px;

        }

        .footer-content img {
            position: absolute;
            bottom: 15px;
            left: 20px;
            width: 60px;
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

                <a class="navbar-brand" href=""></a>
            </div>


            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="navbar-logo">
                        <a href="index.php">
                            <img src="logo_ulb_n3.png" alt="Logo ULB">
                        </a>
                    </li>
                    <!-- <li><a href="pageUnite.php">Unites</a></li> -->

                    <li class="dropdown">
                        <a href="pageUnite.php" class="dropdown-toggle" data-toggle="dropdown">Unités <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($listeIdUnite as $idUnite) {
                                $isActive = isset($_GET['idUnite']) && $_GET['idUnite'] == $idUnite ? 'class="active"' : '';
                                $sql = "SELECT nomUnite FROM unite WHERE id='$idUnite'";
                                $result = $connecte->query($sql);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                $nomUnite = $row['nomUnite'];

                                echo '<li ' . $isActive . '><a href="pageUnite.php?idUnite=' . $idUnite . '"> ' . $nomUnite . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>


                    <!-- <li><a href="pageProjet.php">Projets</a></li> -->

                    <li class="dropdown">
                        <a href="pageProjet.php" class="dropdown-toggle" data-toggle="dropdown">Projets <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($listeIdProjet as $idProjet) {
                                $isActive = isset($_GET['idProjet']) && $_GET['idProjet'] == $idProjet ? 'class="active"' : '';
                                $sql = "SELECT nomProjet FROM projet WHERE id='$idProjet'";
                                $result = $connecte->query($sql);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                $nomProjet = $row['nomProjet'];

                                echo '<li ' . $isActive . '><a href="pageProjet.php?idProjet=' . $idProjet . '"> ' . $nomProjet . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <!-- <li><a href="pageChercheur.php">Chercheurs</a></li> -->

                    <li class="dropdown">
                        <a href="pageChercheur.php" class="dropdown-toggle" data-toggle="dropdown">Chercheurs <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($listeIdChercheur as $idChercheur) {
                                $isActive = isset($_GET['idChercheur']) && $_GET['idChercheur'] == $idChercheur ? 'class="active"' : '';
                                $sql = "SELECT nom, prenom FROM chercheur WHERE id='$idChercheur'";
                                $result = $connecte->query($sql);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];

                                echo '<li ' . $isActive . '><a href="pageChercheur.php?idChercheur=' . $idChercheur . '"> ' . $nom . " " . $prenom . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
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
                <p><a href="#">Link</a></p> -->
            </div>
            <div class="col-sm-8 text-left">
                <h1>Unité de recherche</h1>
                <?php

                //-> Accès DB <------------------------------------------------------------------------------------------------------------------------------------------

                //connexionDB($connecte);

                //$valeurIdProjet = $_GET['idProjet'];


                //-> unité de recherche <--------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT id, nomUnite 
                            FROM unite";

                    $result = $connecte->query($sql);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<a href=pageUnite.php?idUnite=" . $row["id"]  . ">" .

                            $row['nomUnite'] . "<br></a>";
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

<footer class="container-fluid text-center navbar-fixed-bottom">

    <div class="footer-content">
        <img src="logo-ulb.png" alt="Logo ULB">
        <p>Université libre de bruxelles</p>
    </div>
</footer>


</html>