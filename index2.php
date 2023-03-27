<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="name" placeholder="Имя"><br><br>
    <input type="text" name="age" placeholder="Возраст"><br><br>
    <input type="text" name="salary" placeholder="Зарплата"><br><br>
    <button type="submit">Изменить</button>
</form>
</body>
</html>

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

}

if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['salary'])) {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $result = $conn->query("INSERT INTO users (name, age , salary) values ('$name', '$age', '$salary')");

    header("Location: index.php");
}

