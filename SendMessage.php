<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_POST['message'])) {
    exit();
}

$username = $_SESSION['username'];
$message = $_POST['message'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "live_chat";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
