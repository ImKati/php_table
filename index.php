<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Users</title>

</head>

<?php
$host = 'localhost';
$user = 'root';
$password = '12345';
$db_name = 'users';
$conn = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($connections));

if ($conn->connect_error) {
    die("ERROR: Unable to connect: " . $conn->connect_error);
}

echo 'Connected to the database.<br>';

$result = $conn->query("SELECT * FROM users");

echo "Number of rows: $result->num_rows";

echo "<table class='tab'>";

while($user = mysqli_fetch_assoc($result)){
    echo "<tr>
    <td>" . $user['id'] . "</td>
    <td>" . $user['name'] . "</td>
    <td>" . $user['age'] . "</td>
    <td>" . $user['salary'] . "</td>
    <td><a href='index.php?del={$user['id']}'>Delete</a></td>
</tr>";
}

if(isset($_GET['del'])) {
    $del = (int)$_GET['del'];
    $query = "DELETE FROM users WHERE id={'$del'}";
    $result = $conn->query("DELETE FROM users where id={$del}");

    if (!$result) {
        die("Database query failed");
    }

    header("Location: index.php");
}

echo"</table>";
