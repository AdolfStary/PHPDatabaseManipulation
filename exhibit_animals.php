<?php
    require 'constants.php';
    
    $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($connection->connect_error){
        die('Connection Failed: ' . $connection->connect_error);
    }
    if ($_GET && filter_var($_GET['exhibit_id'], FILTER_VALIDATE_INT)){
        $animalsQuery = 'SELECT Name, species.CommonName, species.ScientificName FROM animal INNER JOIN species USING(SpeciesID) INNER JOIN exhibitanimal USING(AnimalID) INNER JOIN exhibit USING(ExhibitID) WHERE ExhibitId = ' . $_GET['exhibit_id'] . ';';
        $exhibitQuery = "SELECT ExhibitName, ExhibitDescription  FROM exhibit WHERE ExhibitID = " . $_GET['exhibit_id'] . ";";
        $animals = $connection->query($animalsQuery);
        $exhibit = $connection->query($exhibitQuery);
    }
    else echo "Wrong input.";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        if($_GET && filter_var($_GET['exhibit_id'], FILTER_VALIDATE_INT)){

            while($row = $exhibit->fetch_assoc()){
                echo "<h2>{$row['ExhibitName']}</h2><p>{$row['ExhibitDescription']}</p>";
            }
            
            echo "<table><tr><th>Name</th><th>Common Name</th><th>Scientific Name</th></tr>";
            while($row = $animals->fetch_assoc()){
                echo "<tr><td>{$row['Name']}</td><td>{$row['CommonName']}</td><td>{$row['ScientificName']}</td></tr>";
            }
            echo "</table>";
        }

        $connection->close();
    ?>    
</body>
</html>