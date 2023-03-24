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

<body>
<form action="index.php" method="post">
    <input type="text" name="name" placeholder="Имя"><br><br>
    <input type="text" name="age" placeholder="Возраст"><br><br>
    <input type="text" name="salary" placeholder="Зарплата"><br><br>
    <button type="submit">Выполнить</button>
</form>
</body>

<?php
$host = 'localhost';
$user = 'root';
$password = '12345';
$db_name = 'users';
$conn = new mysqli($host, $user, $password, $db_name) or die(mysqli_error($conn));

if ($conn->connect_error) {
    die("ERROR: Unable to connect: " . $conn->connect_error);
}

echo 'Connected to the database.<br>';

$result = $conn->query("SELECT * FROM users");

echo "Number of rows: $result->num_rows";

echo "<table class='tab'>";

while ($user = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>" . $user['id'] . "</td>
    <td>" . $user['name'] . "</td>
    <td>" . $user['age'] . "</td>
    <td>" . $user['salary'] . "</td>
    <td><a href='index.php?del={$user['id']}'>Удалить</a></td>
    <td><a href= 'index.php?edit={$user['id']}' target='_blank'>Редактировать</href></td>
    
</tr>";
}


echo "</table>";

if (isset($_GET['del'])) {
    $del = (int)$_GET['del'];
    $result = $conn->query("DELETE FROM users where id={$del}");

    if (!$result) {
        die("Database query failed");
    }

    header("Location: index.php");
}

if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['salary'])) {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $result = $conn->query("INSERT INTO users (name, age , salary) values ('$name', '$age', '$salary')");

    header("Location: index.php");
}

if ((!empty($_REQUEST['name'])) and
    !empty($_REQUEST['age']) and
    !empty($_REQUEST['salary'])) {
    $names = ($_REQUEST['name']);
    $age = strip_tags($_REQUEST['age']);
    $salary = strip_tags($_REQUEST['salary']);
    $name = mysqli_real_escape_string($connections, $names);
    if (isset($_REQUEST['upd'])) {
        if (!empty($_REQUEST)) {
            $upd = $_REQUEST['upd'];
        }
        $query = ("UPDATE users SET name='$name', age= '$age' , salary= '$salary'  WHERE id= $upd ");
        $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
        if (!$result) {
            die("Database query failed");
        }
    }
    header("Location:index.php");
    exit;
}





