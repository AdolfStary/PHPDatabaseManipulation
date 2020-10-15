<?php
    require '../constants.php';

    $connection = new MySQLi(HOST, USER, PASSWORD, DATABASE);
    if($connection->connect_errno) die('Connection failed: ' . $connection->connect_error);

    $getSpeciesQuery = "SELECT SpeciesID, CommonName FROM species;";
    

    if ($_POST){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        $sql = "INSERT INTO animal (SpeciesID, StaffID, Name, Gender, Origin, WeightLbs, DateOfBirth) VALUES ('{$_POST['species']}', '{$_POST['staff']}', '{$_POST['name']}', '{$_POST['gender']}', '{$_POST['origin']}', '{$_POST['weight']}', '{$_POST['dob']}')";
        if ( !$result = $connection->query($sql)) {
            echo "Something went wrong with staff query.";
            exit();
        }


        $connection->close();
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo - Add Animal</title>
</head>
<body>
    <h1>Add an animal</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="species">Species</label>
            <select id="species" name="species">
                <?php
                    if($species = $connection->query($getSpeciesQuery)){
                        while($row = $species->fetch_assoc()){
                            echo "<option value={$row['SpeciesID']}>{$row['CommonName']}</option>";
                        }
                    }
                    
                ?>
            </select>
        </p>
        <p>
            <label for="staff">Species</label>
            <select id="staff" name="staff">
                <option value=1>1</option>
            </select>
        </p>
        <p>
            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="F">Female</option>\
                <option value="M">Male</option>
            </select>
        </p>
        <p>
            <label for="origin">Origin</label>
            <input type="text" name="origin" id="origin">
        </p>
        <p>
            <label for="weight">Weight</label>
            <input type="number" name="weight" id="weight">
        </p>
        <p>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob">
        </p>
            <input type="submit" value="Add new staff member">
    </form>
</body>
</html>