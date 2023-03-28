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
<form action="index2.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['upd']; ?>">
    <input type="text" name="name" placeholder="Имя"><br><br>
    <input type="text" name="age" placeholder="Возраст"><br><br>
    <input type="text" name="salary" placeholder="Зарплата"><br><br>
    <button type="submit">Изменить</button>

</form>
<form  action="index2.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $_GET['upd']; ?>">
    <input type="file" name="filename"><br>
    <input type="submit" value="Отправить">
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

if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['salary']) && isset($_POST['id'])) {

    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $result = $conn->query("UPDATE users SET name = '$name', age = '$age', salary = '$salary' where id={$id} ");

    header("Location: index.php");
}

if(move_uploaded_file($_FILES['filename']['tmp_name'], 'temp/' . $_FILES['filename']['name'])){
    $id = (int)$_POST['id'];
    $include_path = $_FILES['filename']['tmp_name'];

    echo "UPDATE users SET avatar = '$include_path' where id={$id}";
    //$result = $conn->query("UPDATE users SET avatar = '$path_to_avatar' where id={$id}");
    echo 'Файл скопирован на сервер';
}else{
    //echo 'Файл не скопировался на сервер';
};


