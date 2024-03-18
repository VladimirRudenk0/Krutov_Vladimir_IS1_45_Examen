<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autorizregistrbd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accountuser WHERE username=? AND password=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Авторизация успешна!";
        echo '<script>setTimeout(function(){ alert("Авторизация успешна!"); window.location.href = "index3.html"; }, 2000);</script>';
    } else {
        echo "Неверное имя пользователя или пароль!";
    }

    $stmt->close();
}

$conn->close();
?>