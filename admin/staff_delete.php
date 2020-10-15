<?php
    require '../constants.php';

    $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

    $deleted = false;
    if ($connection->connect_error){
        die('Connection Failed: ' . $connection->connect_error);
    }
    
    if(stristr($_GET['staff_id'], ";") || stristr($_GET['staff_id'], "=")){
        echo "Invalid input!";
        die();
    }


    $sql = "SELECT FirstName, LastName FROM staff WHERE StaffID = ". $_GET['staff_id'] . ";";

    if ( !$result = $connection->query($sql)) {
        echo "Something went wrong with staff query.";
        exit();
    }
    else{
        while($myResults = $result->fetch_assoc()){
            $firstName = $myResults['FirstName'];
            $lastName = $myResults['LastName'];
        }
        
    }

    if($_POST)
    {
        $checkQuery = "SELECT * FROM animal WHERE StaffID=". $_POST['staffid'] .";";
        $animalList = $connection->query($checkQuery);

        if ($animalList->num_rows == 0) {
            $delQuery = "DELETE FROM staff WHERE StaffID=". $_POST['staffid'] .";";
            $connection->query($delQuery);
            $deleted = true;
        }
        else echo "Cannot delete a staff member as he/she currenlty has animals under his/her care.";
            
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Staff Delete</title>
</head>
<body>
<?php
    if ($deleted){
        echo "Staff member was deleted";
    }
    else
        echo "<form action='#' method='POST'>
                Are you sure you want to delete ". $firstName . " " . $lastName . "?
                <label for='staffid' hidden>StaffID</label><input type='text' id='staffid' name='staffid' value=". $_GET['staff_id'] ." hidden/> 
                <input type='submit' value='Delete'>
              </form>";

?>
</body>
</html>