<?php
$servername = "127.0.0.1";
$username = "php_projects";
$password = "php_projects";
$dbname = "feb8task";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn) {
        echo "Connected to the database successfully!";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
