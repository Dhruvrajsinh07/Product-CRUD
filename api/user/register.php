<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$q = "INSERT INTO `userdetail`(`name`, `email`, `password`) VALUES (?,?,?)";
$param = [$name,$email,$password];

$stmt = $conn->prepare($q);
$user = $stmt->execute($param);

if($user > 0){
    echo json_encode(['success' => true , 'message' => "User Registered"]);
}else{
    echo json_encode(['success' => false , 'message' => "User Not Registered"]);
}

?>

