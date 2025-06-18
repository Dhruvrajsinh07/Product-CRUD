<?php


include __DIR__ . '/../includes/header.php';
require_once "../includes/init.php";


$q = "SELECT * FROM `category`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background: linear-gradient(to bottom right, #a855f7, #f472b6, #38bdf8);
            animation: bg-fade 12s infinite alternate ease-in-out;
            padding: 2rem;
            color: #333;
        }
        @keyframes bg-fade {
            0% { background-position: left; }
            100% { background-position: right; }
        }
        h1 {
            text-align: center;
            color: #fff;
            margin-top: 2rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }
        form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 1rem;
            max-width: 700px;
            margin: 0 auto 2rem auto;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        label, select, input[type="text"], input[type="number"] {
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }
        select:focus, input[type="text"]:focus, input[type="number"]:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 5px rgba(56, 189, 248, 0.5);
        }
        input[type="button"] {
            background-color: #38bdf8;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        input[type="button"]:hover {
            background-color: #0ea5e9;
            transform: scale(1.05);
        }
        .container {
            margin-top: 2rem;
        }
        .table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        .table:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        a {
            text-decoration: none;
            color: #6f42c1;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        a:hover {
            color: #5a379f;
            transform: scale(1.05);
        }
        .back-button {
            display: block;
            text-align: center;
            margin-bottom: 2rem;
        }
        .back-button a {
            background-color: #fca5a5;
            color: #fff;
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .back-button a:hover {
            background-color: #f87171;
            transform: scale(1.05);
        }
        .select-container {
            display: flex;
            justify-content: center;
            margin: 1rem 0;
            gap: 1rem;
            align-items: center;
        }
    </style>
</head>
<body>
    
    <h1>Product page</h1>

    <div class="back-button">
        <a href="../index.php">⬅ Back to Dashboard</a>
    </div>

    <div class="select-container">
        <label for="cid">Select Category :</label>
        <select id="cid">
            <?php foreach($row as $r): ?>
                <option value="<?= $r['c_id']?>">
                    <?= $r['cname']?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <form method="post">
        <input type="text" name="pro" id="pro" placeholder="Enter the product">
        <input type="number" name="price" id="price" placeholder="Enter the price">
        <input type="button" value="ADD" onclick="insertproduct();">
    </form>

    <div class="container">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category-Id</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="tbody"></tbody>
        </table>
    </div>

    <script>

    $(displaypro());

    function insertproduct(){
        let data = {
            cid: $('#cid').val(),
            pro : $('#pro').val(),
            price :$('#price').val()
        };
        console.log(data);

        $.ajax({
            url: '../api/product/insert.php',
            method: "POST",
            data :data,
            success:function(response){
                console.log(response);
                alert("Product added successfully");
                displaypro();
                $('#pro').val("");
                $('#price').val("");
                $('#pro').focus("");
            },
            error:function(error){
                console.log(error);
                alert("Product not added");
            }
        });
    }

    function displaypro(){
        $.ajax({
            url: "../api/product/display.php",
            method: "POST",
            success:function(response){
                let record = "";
                if(response.product && response.product.length > 0){
                    for(let i = 0;i < response.product.length;i++){
                        record +=
                            `<tr>
                                <td scope="col">${response.product[i].pid}</td>
                                <td scope="col">${response.product[i].pname}</td>
                                <td scope="col">${response.product[i].price}</td>
                                <td scope="col">${response.product[i].cid}</td>
                                <td scope="col"><a href="./update_p.php?id=${response.product[i].pid}">Update</a></td>
                                <td scope="col"><a href="#" onclick="deletepro(${response.product[i].pid})">Delete</a></td>
                            </tr>`
                    }
                } else {
                    record += `<tr><td colspan = "6" style="text-align:center ;"> No Records</td></tr>`
                }
                $("#tbody").html(record);
            },
            error:function(error){
                console.log(error);
            }
        });
    }

    function deletepro(pid){
        $.ajax({
            url:"../api/product/delete.php",
            method: "POST",
            data : {
                pid:pid
            },
            success:function(response){
                displaypro();
            },
            error:function(error){
                console.log(error);
            }
        });
    }
    </script>
</body>
</html>
