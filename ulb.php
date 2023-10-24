<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ulb</title>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $connecte = new PDO("MariaDB:host=$servername;dbname=ulb", $username, $password);
        // set the PDO error mode to exception
        $connecte->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $sql = "SELECT id, nom, prenom FROM chercheur";
    $result = $connecte->query($sql);
    ?>


</body>

</html>