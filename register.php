<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autorizregistrbd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Проверка на существующий username
$check_query = "SELECT * FROM accountuser WHERE username = '$username'";
$result = $conn->query($check_query);

if ($result->num_rows > 0) {
    echo "Пользователь с таким именем уже существует.";
} else {
    if ($password === $confirm_password) {
        $sql = "INSERT INTO accountuser (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Пользователь успешно зарегистрирован.";
            echo '<script>setTimeout(function(){ alert("Регистрация успешна!"); window.location.href = "index.html"; }, 2000);</script>';
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Пароли не совпадают.";
    }
}

$conn->close();
?>