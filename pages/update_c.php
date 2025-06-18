<?php

include __DIR__ . '/../includes/header.php';
require_once '../includes/init.php';

if(!isset($_GET['id'])){
    header("../index.php");
}
$id = $_GET['id'] ?? null;

$q = "SELECT * FROM `category` WHERE `c_id` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$cat = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background: linear-gradient(to right, #c084fc, #f0abfc, #7dd3fc);
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            animation: bgFlow 10s infinite alternate;
        }
        @keyframes bgFlow {
            0% { background-position: left; }
            100% { background-position: right; }
        }
        h1 {
            color: #fff;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }
        input[type="text"], input[type="hidden"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.25rem;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }
        input[type="text"]:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 5px rgba(56, 189, 248, 0.5);
        }
        input[type="button"] {
            width: 100%;
            background-color: #38bdf8;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        input[type="button"]:hover {
            background-color: #0ea5e9;
            transform: scale(1.03);
        }
    </style>
</head>
<body>

<h1>Update page</h1>
<br>

<form action="" method="post">
    <input type="hidden" name="id" id="id" value="<?= $cat['c_id'] ?>">
    <input type="text" name="name" id="name" placeholder="Enter The CATEGORY" value="<?= $cat['cname'] ?>">
    <input type="button" value="Update" onclick="updatecat()">
</form>

<script>
    function updatecat(c_id){
        let data = {
            id: $("#id").val(),
            name: $("#name").val()
        }

        $.ajax({
            url: "../api/category/update.php",
            method: "POST",
            data: data,
            success: function(response){
                if(response.success != true){
                    alert("Something Went Wrong");
                } else {
                    window.location.href = "./category.php"
                }
                console.log(response);
            },
            error: function(error){
                console.log(error);
            },
        });
    }
</script>

</body>
</html>
