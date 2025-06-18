<?php

include __DIR__ . '/../includes/header.php';
require_once '../includes/init.php';

if(!isset($_GET['id'])){
    header("./index.php");
}
$id = $_GET['id'] ?? null;

$q = "SELECT * FROM `product` WHERE `pid` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$pro = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background: linear-gradient(to right, #38bdf8, #a855f7, #f472b6);
            padding: 2rem;
            color: #333;
            min-height: 100vh;
        }
        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 2rem;
            font-weight: bold;
        }
        form {
            background-color: rgba(255, 255, 255, 0.97);
            padding: 2rem;
            border-radius: 1rem;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        input[type="text"], input[type="number"] {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 5px rgba(56, 189, 248, 0.4);
        }
        input[type="button"] {
            padding: 0.7rem 1.5rem;
            background-color: #38bdf8;
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        input[type="button"]:hover {
            background-color: #0ea5e9;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
<h1>Update page</h1>
<br>
    
<form method="post">
    <input type="hidden" name="id" id="id" value="<?= $pro['pid'] ?>">
    <input type="text" name="pro" id="pro" placeholder="Enter the product" value="<?= $pro['pname'] ?>">
    <input type="number" name="price" id="price" placeholder="Enter the price" value="<?= $pro['price'] ?>">
    <input type="button" value="Update" onclick="updatepro()">
</form>

<script>
    function updatepro(){
        let data = {
            id:$('#id').val(),
            pro:$('#pro').val(),
            price:$('#price').val(),
        };
        $.ajax({
            url:"../api/product/update.php",
            method: "POST",
            data:data,
            success:function(response){
                if(response.success != true){
                    alert("Something Went Wrong");
                }else{
                    window.location.href = "./product.php";
                }
            },
            error:function(error){
                console.log(error);
            }
        });
    }
</script>
    
</body>
</html>
