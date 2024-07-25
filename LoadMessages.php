<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "live_chat";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query("SELECT username, message, timestamp FROM messages ORDER BY timestamp ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        echo "<div class='message'><strong>{$message['username']}:</strong> {$message['message']} <em>({$message['timestamp']})</em></div>";
    }
} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
