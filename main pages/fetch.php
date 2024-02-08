<?php
$servername = "127.0.0.1";
$username = "php_projects";
$password = "php_projects";
$dbname = "feb8task";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM tbl_category";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = array();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[$row['category_id']] = array(
            'text'     => $row["category_name"],
            'parent'   => $row["parent_category_id"]
        );
    }
    $tree = buildTree($data);
    echo json_encode($tree);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function buildTree(array &$data, $parent = 0) {
    $tree = array();
    foreach ($data as $id => &$node) {
        if ($node['parent'] == $parent) {
            $children = buildTree($data, $id);
            if ($children) {
                $node['nodes'] = $children;
            }
            $tree[] = $node;
            unset($data[$id]);
        }
    }
    return $tree;
}
?>
