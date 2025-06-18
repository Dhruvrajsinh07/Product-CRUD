<?php

require_once '../../includes/init.php';
header("Content-Type: application/json");

$categoryname = $_POST['name'] ?? null;

if($categoryname)
{
    $query = "INSERT INTO `category`(`cname`) VALUES (?)";
    $params = [$categoryname];

    $stmt = $conn->prepare($query);
    $row = $stmt->execute($params);

    if($row > 0)
    {
        echo json_encode(['success' => true, 'message' => 'data inserted.']);
    }
    else
    {
        echo json_encode(['success' => false, 'message' => 'invalid data']);
    }

}
else
{
    echo json_encode(['success' => false, 'message' => 'missing data']);
}

?>