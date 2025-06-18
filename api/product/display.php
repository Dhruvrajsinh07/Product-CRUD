<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$q = "SELECT * FROM `product`";

$stmt = $conn->prepare($q);
$stmt->execute();

$product = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($product != null){
    echo json_encode(['success' => true, 'product' => $product]);
}else{
    echo json_encode(['success' => false, 'message' => "Data Not Displayed"]);

}
?>