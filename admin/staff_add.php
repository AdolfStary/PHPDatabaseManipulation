<?php
    require '../constants.php';

    if ($_POST){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $connection = new MySQLi(HOST, USER, PASSWORD, DATABASE);
        if($connection->connect_errno) die('Connection failed: ' . $connection->connect_error);

        // Can also filter Post variable with $connection->real_escape_string($_POST['first_name']);
        $statement = $connection->prepare("INSERT INTO staff (FirstName, LastName) VALUES(?,?);");
        $statement->bind_param("ss", $_POST['first_name'], $_POST['last_name']);

        if($statement->execute() ) echo "Yaay, added a staff member.";
        else echo "There was a problem adding a staff member.";

        $statement->close();
        $connection->close();
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo - Add Staff</title>
</head>
<body>
    <h1>Add a staff member</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name">
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name">
        </p>
            <input type="submit" value="Add new staff member">
    </form>
</body>
</html>