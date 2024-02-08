<?php
$servername = "127.0.0.1";
$username = "php_projects";
$password = "php_projects";
$dbname = "feb8task";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["category_name"]) && isset($_POST["parent_category"])) {
            $category_name = trim($_POST["category_name"]);
            if (empty($category_name)) {
                echo "Error: UserName is required.";
            } else {
                $query = "INSERT INTO tbl_category (category_name, parent_category_id) VALUES (:category_name, :parent_category)";
                $statement = $conn->prepare($query);
                $statement->execute(
                    array(
                        ':category_name'   => $category_name,
                        ':parent_category' => $_POST["parent_category"]
                    )
                );

                echo "User added successfully!";
            }
        } else {
            echo "Error: Missing category_name or parent_category in the form data.";
        }
    } else {
        echo "Error: Form not submitted using POST method.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
