<?php
    require '../constants.php';

    $staffMembers = null;

    $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($connection->connect_error){
        die('Connection Failed: ' . $connection->connect_error);
    }
    
    $sql = "SELECT * FROM Staff";

    if ( !$result = $connection->query($sql)) {
        echo "Something went wrong with staff query.";
        exit();
    }

    if( 0 === $result->num_rows)
    {
        $staffMembers = "<tr><td colspan='4'>There are no staff members</td></tr>";
    }
    else
    {
        while ($row = $result->fetch_assoc()){
            // $staffMembers .= sprintf();   Sprintf allows to format string output
            $staffMembers .= "
            <tr>
            <td>{$row['StaffID']}</td>
            <td>{$row['FirstName']}</td>
            <td>{$row['LastName']}</td>
            <td><a href='staff_edit.php?staff_id=" . $row['StaffID'] . "'>Edit</a><a href='staff_delete.php?staff_id=" . $row['StaffID'] . "'>Delete</a></td>
            </tr>
            ";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Staff List</title>
</head>
<body>
    <h1>Staff Members</h1>
    <table>
        <tr>
            <th>Staff ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Actions</th>
        </tr>
        <?php echo $staffMembers; ?>
    </table>
</body>
</html>