<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "live_chat";

try {
    $db = new PDO("mysql:host=$servername", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    $db->exec("USE $dbname");

    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50),
        message TEXT,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";
    $db->exec($createTableQuery);

} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
    exit();
}

if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    header("Location: Chat.php");
    exit();
}

if (isset($_SESSION['username'])) {
    header("Location: Chat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">Giriş Yap</div>
        <form class="login" method="post" action="">
            <input class="input" type="text" name="username" placeholder="Kullanıcı adı" required>
            <button class="button" type="submit">Giriş Yap</button>
        </form>
        <footer>Made by <a href="https://github.com/ayd1ndemirci" target="_blank">ayd1ndemirci</a></footer>
    </div>
</body>
</html>
