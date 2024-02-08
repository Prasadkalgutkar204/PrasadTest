<?php
$servername = "127.0.0.1";
$username = "php_projects";
$password = "php_projects";
$dbname = "feb8task";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM tbl_category WHERE parent_category_id = 0";
    $statement = $conn->prepare($query);
    $statement->execute();
    $output = '';
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $output .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
    }
    echo $output;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
