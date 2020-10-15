<?php 
    require 'constants.php';
    
    $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

    $numberOfExhibits = 0;

    if ($connection->connect_error){
        die('Connection Failed: ' . $connection->connect_error);
    }
    



    $sql = 'SELECT COUNT(ExhibitID) AS Total, ExhibitName, ExhibitDescription, ExhibitID  FROM exhibit WHERE NOW() BETWEEN StartDate AND EndDate';
    $result = $connection->query($sql);
    $numberOfExhibits = $result->num_rows;

    echo "We have {$numberOfExhibits} Exhibit Open:";
    if ($result->num_rows > 0){

        
        while($row = $result->fetch_assoc())
        {
            
            echo "<h1>{$row['ExhibitName']}</h1><p>{$row['ExhibitDescription']}</p>";
            echo "<a href=exhibit_animals.php?exhibit_id={$row['ExhibitID']}>View Animals</a>";
        }
    }

    $connection->close();

?>