<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$email = $_POST["email"] ?? null;
$password = $_POST["password"] ?? null;

$q = "SELECT * FROM `userdetail` WHERE `email` = ? and `Password` = ?";
$params = [$email, $password];


$stmt = $conn->prepare($q);
$stmt->execute($params);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    echo json_encode(['success' => true, 'user' => $user]);
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
    $_SESSION['username'] = $user['name'];  

}
else{
    $q2 = "SELECT * FROM `userdetail` WHERE `email` = ?";

    $stmt2 = $conn->prepare($q2);
    $stmt2->execute([$email]);
    $checkmail = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    
    if (!$checkmail) {
        echo json_encode(['success' => false, 'reason' => 'email']);
    } else {
        echo json_encode(['success' => false, 'reason' => 'password']);
    }
}

?>