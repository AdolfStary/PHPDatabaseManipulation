<?php
    require '../constants.php';

    $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);
    $firstName = "";
    $lastName = "";

    if ($connection->connect_error){
        die('Connection Failed: ' . $connection->connect_error);
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


    if($_POST){
        $editQuery = "UPDATE staff SET FirstName = '". $_POST['firstName'] ."', LastName = '". $_POST['lastName'] ."' WHERE StaffID = ". $_GET['staff_id'] ."; ";
        if ($connection->query($editQuery)){
            echo "Changed were saved.";
        }
        else echo "There was an issue saving changes.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Staff Edit</title>
</head>
<body>
    <h1>Edit Staff Member</h1>
    <form action="#" method="POST">
        <label for="firstName">First Name</label><input type="text" id="firstName" name="firstName" value="<?php echo $firstName;  ?>" /> 
        <label for="lastName">Last Name</label><input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" />
        <input type="submit">
    </form>
</body>
</html>