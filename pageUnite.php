<?php
require_once("accesDB.php");

// info page bien déjà bien commenté !!

// Récupération des identifiants d'unités depuis la base de données
$listeIdUnite = array();
if ($connecte) {

    // Requête SQL pour obtenir les identifiants et noms d'unités
    $sql = "SELECT id, nomUnite  
            FROM unite";

    $result = $connecte->query($sql);

    // Boucle pour stocker les identifiants d'unités dans $listeIdUnite
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $listeIdUnite[] = $row['id'];
    }
} else {
    echo "La connexion à la base de données a échoué.";
}

// Récupération des identifiants de projets depuis la base de données
$listeIdProjet = array();
if ($connecte) {
    $sql = "SELECT id, nomProjet  
            FROM projet";

    $result = $connecte->query($sql);

    // Boucle pour stocker les identifiants de projets dans $listeIdProjet
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $listeIdProjet[] = $row['id'];
    }
} else {
    echo "La connexion à la base de données a échoué.";
}

// Récupération des identifiants de chercheurs depuis la base de donnée
$listeIdChercheur = array();
if ($connecte) {
    $sql = "SELECT id, nom, prenom 
            FROM chercheur";

    $result = $connecte->query($sql);

    // Boucle pour stocker les identifiants de chercheurs dans $listeIdChercheur
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
    <title>Page Unite</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */

        /* Barre de navigation */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
            background-color: #22427C;
        }

        /* Onglet actif */
        .active a {
            background-color: #03224C !important;
            /* Changez la couleur ici selon votre préférence */
        }

        /* Logo de la barre de navigation */
        .navbar-logo {
            position: absolute;
            bottom: 2px;
        }

        /* Taille du logo de la barre de navigation */
        .navbar-logo img {
            width: 160px;
        }

        /* Hauteur de la grille pour que .sidenav puisse être à 100% (ajuster si nécessaire) */

        /* Contenu de la colonne */
        .row.content {
            height: 450px;
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: white;
            height: 100%;
        }

        /* Positionnement du paragraphe dans le pied de page */
        footer {
            background-color: #03224C;
            color: white;
            padding: 30px;
        }

        /* Positionnement de l'image dans le pied de page */
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


        /* Sur les petits écrans, ajuste la hauteur de .sidenav et de la grille à 'auto' */
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

            <!-- Contenu de la barre de navigation -->
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">

                    <!-- Logo -->
                    <li class="navbar-logo">
                        <a href="index.php">
                            <img src="logo_ulb_n3.png" alt="Logo ULB">
                        </a>
                    </li>

                    <!-- Liste déroulante pour les Unités -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Unités <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <!-- PHP pour afficher les Unités -->
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

                    <!-- Liste déroulante pour les Projets -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projets <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <!-- PHP pour afficher les Projets -->
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

                    <!-- Liste déroulante pour les Chercheurs -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chercheurs <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <!-- PHP pour afficher les Chercheurs -->
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

                <!-- Connexion à droite -->
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

                //connexionDB($connecte);

                $valeurIdUnite =  $_GET['idUnite'];

                $monFichier = fopen("uniteFile.txt", "w") or die("Error impossible d'ouvrir le fichier!");

                //-> Détaillé info unité <--------------------------------------------------------------------------------------------------------------------------------

                //  Affichage des listes d'unités
                if ($connecte) {
                    $sql = "SELECT id as numUnite, nomUnite, description 
                            FROM unite 
                            WHERE id='$valeurIdUnite'";

                    $result = $connecte->query($sql);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        // Affichage des détails de l'unité
                        echo "(Code : " . $row['numUnite'] . ")" . "<br>" .
                            $row['nomUnite'] . " <br> <br>" .
                            "Description : <br>" . $row['description'] . " <br><br>";

                        // Écriture des détails dans le fichier
                        fwrite($monFichier, $row['numUnite']  . "\n");
                        fwrite($monFichier, $row['nomUnite'] .  "\n");
                        fwrite($monFichier, $row['description'] .  "\n");
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }

                fwrite($monFichier, "\n");


                //-> Responsable(s) de l'unité <-------------------------------------------------------------------------------------------------------------------------------------

                if ($connecte) {
                    $sql = "SELECT c.id as numChercheur, c.nom, c.prenom, pc.idProjet as numProjet
                            FROM uchercheur uc, chercheur c, uprojet up, pchercheur pc
                            WHERE uc.resp ='responsable' /*  */
                                
                                AND uc.idChercheur = c.id
                            
                                AND pc.idChercheur= c.id

                                AND pc.idProjet=up.idProjet

                                AND uc.idUnite = '$valeurIdUnite'

                            GROUP BY c.id, c.nom, c.prenom";


                    $result = $connecte->query($sql);

                    $cptResponsable = $result->rowCount();

                    if ($cptResponsable == 1) {
                        echo "<p> Le Responsable : <p>";
                    } else {
                        echo "<p> Les Responsables : <p>";
                    }

                    // Affichage des responsables
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<a href=pageChercheur.php?idChercheur=" . $row['numChercheur'] . "&idUnite=" . $valeurIdUnite . "&idProjet=" . $row['numProjet'] . ">" .
                            $row['nom'] . " " . $row['prenom'] . " <br> </a>" . " \n";

                        // Écriture des noms dans le fichier
                        fwrite($monFichier, $row['nom'] . " ");
                        fwrite($monFichier, $row['prenom'] . "\n");
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }

                fwrite($monFichier, "\n");


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

                    // Affichage des projets
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<a href=pageProjet.php?idProjet=" . $row["id"] . "&idUnite=" . $valeurIdUnite . ">" .

                            $row['nomProjet']  . "<br></a>";

                        // Écriture des noms de projet dans le fichier
                        fwrite($monFichier,  $row['nomProjet'] . "\n");
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }

                fwrite($monFichier, "\n");



                //-> les chercheurs qui y travailles <--------------------------------------------------------------------------------------------------------------------- 

                // Affichage des chercheurs travaillant dans l'unité sans responsabilité spécifique
                if ($connecte) {

                    $sql = "SELECT c.id as numchercheur, c.nom , c.prenom, pc.idProjet as numProjet
                            FROM uchercheur uc, chercheur c, uprojet up, pchercheur pc
                            WHERE uc.resp=''

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

                    // Affichage des chercheurs
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        echo  "<a href=pageChercheur.php?idChercheur=" . $row['numchercheur']  . "&idUnite=" . $valeurIdUnite . "&idProjet=" . $row['numProjet'] . ">" .
                            $row['nom'] . " " . $row['prenom'] . "<br> </a>";

                        // Écriture des noms de chercheurs dans le fichier
                        fwrite($monFichier, $row['nom'] . " ");
                        fwrite($monFichier, $row['prenom'] . "\n");
                    }
                } else {
                    echo "La connexion à la base de données a échoué, donc la requête SQL n'a pas été exécutée.";
                }


                //Fermeture et lien pour télécharger le fichier texte uniteFile.txt

                fclose($monFichier);
                echo "<br> <a href=uniteFile.txt><button>Enregistrer la page</button></a>";


                /*$destinataire = 'monclient@yopmail.com';
                $sujet = '-20% sur les stylos';
                $body = 'Bonjour! ' . "nn " . 'Venez acheter des stylos chez VendeuxDeStylo, des réduction à plus de -20 pour vous !';
                mail($destinataire, $sujet, $body);*/

                // Vérifie si l'ID de l'unité est spécifié



                if (isset($_GET['idUnite'])) {
                    $valeurIdUnite = $_GET['idUnite'];

                    // Récupération des informations de l'unité depuis la base de données
                    if ($connecte) {
                        $sql = "SELECT id as numUnite, nomUnite, description 
                                FROM unite 
                                WHERE id='$valeurIdUnite'";

                        $result = $connecte->query($sql);

                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendMail'])) {

                            // Vérifie si l'unité existe
                            if ($result->rowCount() > 0) {
                                $unite = $result->fetch(PDO::FETCH_ASSOC);

                                // Créez un fichier texte temporaire avec les informations de l'unité
                                $tempFile = tempnam(sys_get_temp_dir(), 'unit_details');
                                $fileContent = "Nom de l'unité : " . $unite['nomUnite'] . "\n";
                                $fileContent .= "ID de l'unité : " . $unite['numUnite'] . "\n";
                                $fileContent .= "Description de l'unité : " . $unite['description'];
                                file_put_contents($tempFile, $fileContent);

                                // Adresse e-mail du destinataire
                                $to = 'the.real.netnija@yopmail.com';

                                // Adresse e-mail du deuxième destinataire
                                $cc = 'prosprs@yopmail.com';

                                // Sujet de l'e-mail
                                $subject = "Détails de l'unité : " . $unite['nomUnite'];

                                // Message de l'e-mail
                                $message = "Veuillez trouver les détails de l'unité en pièce jointe.";

                                // Adresse e-mail de l'expéditeur
                                $from = 'suedymud@hotmail.com';

                                // En-têtes de l'e-mail
                                $headers = "From: $from\r\n";
                                $headers .= "Reply-To: $from\r\n";
                                $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: multipart/mixed; boundary=\"mixed_boundary\"\r\n";

                                // Message au format texte
                                $bodyText = "--mixed_boundary\r\n";
                                $bodyText .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
                                $bodyText .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                                $bodyText .= $message . "\r\n\r\n";

                                // Attachement du fichier texte
                                $attachment = chunk_split(base64_encode(file_get_contents($tempFile)));
                                $bodyText .= "--mixed_boundary\r\n";
                                $bodyText .= "Content-Type: application/octet-stream; name=\"unit_details.txt\"\r\n";
                                $bodyText .= "Content-Disposition: attachment; filename=\"unit_details.txt\"\r\n";
                                $bodyText .= "Content-Transfer-Encoding: base64\r\n\r\n";
                                $bodyText .= $attachment . "\r\n\r\n";



                                // Envoi de l'e-mail
                                if (mail($to, $subject, $bodyText, $headers)) {
                                    echo "<p>Mail envoyé avec succès.</p>";
                                } else {
                                    echo "<p>Erreur lors de l'envoi de l'e-mail.</p>";
                                }

                                // Suppression du fichier texte temporaire
                                unlink($tempFile);
                            } else {
                                echo "L'unité demandée n'a pas été trouvée.";
                            }
                        }
                    } else {
                        echo "La connexion à la base de données a échoué.";
                    }
                } else {
                    echo "L'ID de l'unité n'est pas spécifié.";
                }
                ?>

                <!-- Formulaire pour envoyer l'e-mail -->

                <form method="post">
                    <input type="hidden" name="sendMail" value="true">
                    <button type="submit">Envoyer un mail</button>
                </form>

                <?php

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




</body>

<footer class="container-fluid text-center navbar-fixed-bottom">

    <div class="footer-content">
        <img src="logo-ulb.png" alt="Logo ULB">
        <p>Université libre de bruxelles</p>
    </div>
</footer>

</html>





<?php
/*
if ($unite) {
// Créez un fichier texte temporaire avec les informations de l'unité
$tempFile = tempnam(sys_get_temp_dir(), 'unit_details');
$fileContent = "Nom de l'unité : " . $unite['unite_name'] . "\n";
$fileContent .= "ID de l'unité : " . $unite['unite_id'] . "\n";
$fileContent .= "Description de l'unité : " . $unite['unite_description'];
file_put_contents($tempFile, $fileContent);

// Adresse e-mail du destinataire
$to = 'test@yopmail.com';

// Adresse e-mail du deuxième destinataire
$cc = 'prosprs@gmail.com';

// Sujet de l'e-mail
$subject = "Détails de l'unité : " . $unite['unite_name'];

// Message de l'e-mail
$message = "Veuillez trouver les détails de l'unité en pièce jointe.";

// Adresse e-mail de l'expéditeur
$from = 'suedymud@hotmail.com';

// En-têtes de l'e-mail
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"mixed_boundary\"\r\n";

// Message au format texte
$bodyText = "--mixed_boundary\r\n";
$bodyText .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
$bodyText .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$bodyText .= $message . "\r\n\r\n";

// Attachement du fichier texte
$attachment = chunk_split(base64_encode(file_get_contents($tempFile)));
$bodyText .= "--mixed_boundary\r\n";
$bodyText .= "Content-Type: application/octet-stream; name=\"unit_details.txt\"\r\n";
$bodyText .= "Content-Disposition: attachment; filename=\"unit_details.txt\"\r\n";
$bodyText .= "Content-Transfer-Encoding: base64\r\n\r\n";
$bodyText .= $attachment . "\r\n\r\n";

// Envoi de l'e-mail
if (mail($to, $subject, $bodyText, $headers)) {
echo "E-mail envoyé avec succès.";
} else {
echo "Erreur lors de l'envoi de l'e-mail.";
}

// Suppression du fichier texte temporaire
unlink($tempFile);
} else {
echo "L'unité demandée n'a pas été trouvée.";
}
} else {
echo "L'ID de l'unité n'est pas spécifié.";
}

------------------------------------------------------------ backup code envois de mail ----------------------------------------
if (isset($_GET['idUnite'])) {
                    $valeurIdUnite = $_GET['idUnite'];

                    // Récupération des informations de l'unité depuis la base de données
                    if ($connecte) {
                        $sql = "SELECT id as numUnite, nomUnite, description 
                                FROM unite 
                                WHERE id='$valeurIdUnite'";

                        $result = $connecte->query($sql);


                        // Vérifie si l'unité existe
                        if ($result->rowCount() > 0) {
                            $unite = $result->fetch(PDO::FETCH_ASSOC);

                            // Créez un fichier texte temporaire avec les informations de l'unité
                            $tempFile = tempnam(sys_get_temp_dir(), 'unit_details');
                            $fileContent = "Nom de l'unité : " . $unite['nomUnite'] . "\n";
                            $fileContent .= "ID de l'unité : " . $unite['numUnite'] . "\n";
                            $fileContent .= "Description de l'unité : " . $unite['description'];
                            file_put_contents($tempFile, $fileContent);

                            // Adresse e-mail du destinataire
                            $to = 'the.real.netnija@yopmail.com';

                            // Adresse e-mail du deuxième destinataire
                            $cc = 'prosprs@yopmail.com';

                            // Sujet de l'e-mail
                            $subject = "Détails de l'unité : " . $unite['nomUnite'];

                            // Message de l'e-mail
                            $message = "Veuillez trouver les détails de l'unité en pièce jointe.";

                            // Adresse e-mail de l'expéditeur
                            $from = 'suedymud@hotmail.com';

                            // En-têtes de l'e-mail
                            $headers = "From: $from\r\n";
                            $headers .= "Reply-To: $from\r\n";
                            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: multipart/mixed; boundary=\"mixed_boundary\"\r\n";

                            // Message au format texte
                            $bodyText = "--mixed_boundary\r\n";
                            $bodyText .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
                            $bodyText .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                            $bodyText .= $message . "\r\n\r\n";

                            // Attachement du fichier texte
                            $attachment = chunk_split(base64_encode(file_get_contents($tempFile)));
                            $bodyText .= "--mixed_boundary\r\n";
                            $bodyText .= "Content-Type: application/octet-stream; name=\"unit_details.txt\"\r\n";
                            $bodyText .= "Content-Disposition: attachment; filename=\"unit_details.txt\"\r\n";
                            $bodyText .= "Content-Transfer-Encoding: base64\r\n\r\n";
                            $bodyText .= $attachment . "\r\n\r\n";


                            // Envoi de l'e-mail
                            if (mail($to, $subject, $bodyText, $headers)) {

                                echo "<p>Mail envoyé avec succès.</p>";
                            } else {
                                echo "<p>Erreur lors de l'envoi de l'e-mail.</p>";
                            }

                            // Suppression du fichier texte temporaire
                            unlink($tempFile);
                        } else {
                            echo "L'unité demandée n'a pas été trouvée.";
                        }
                    } else {
                        echo "La connexion à la base de données a échoué.";
                    }
                } else {
                    echo "L'ID de l'unité n'est pas spécifié.";
                }
*/
?>