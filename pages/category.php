<?php
include __DIR__ . '/../includes/header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
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
            margin-bottom: 2rem;
            font-weight: bold;
        }
        .back-btn {
            display: block;
            width: fit-content;
            margin: 0 auto 2rem auto;
            background-color: #fff;
            color: #0ea5e9;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: background 0.3s, transform 0.3s;
        }
        .back-btn:hover {
            background-color: #e0f2fe;
            transform: scale(1.05);
        }
        form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 1rem;
            max-width: 700px;
            margin: 0 auto 2rem auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
        }
        form:hover {
            transform: scale(1.01);
        }
        label {
            font-weight: 600;
            margin-right: 0.5rem;
        }
        input[type="text"] {
            border-radius: 10px;
            padding: 0.5rem;
            width: 60%;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }
        input[type="text"]:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 5px rgba(56, 189, 248, 0.5);
        }
        input[type="button"] {
            margin-left: 1rem;
            background-color: #38bdf8;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        input[type="button"]:hover {
            background-color: #0ea5e9;
            transform: scale(1.05);
        }
        .table {
            background: #ffffffdd;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        .table th {
            background: #e0f2fe;
            font-weight: 600;
        }
        .table td, .table th {
            padding: 1rem;
            border: none;
        }
        .table tbody tr:hover {
            background: #f0f9ff;
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
    </style>
</head>
<body>
    <h1>Category Add Page</h1>

    <a class="back-btn" href="../index.php">⬅ Back to Dashboard</a>

    <form>
        <div class="mb-3 d-flex align-items-center justify-content-center">
            <label for="category" class="form-label me-2">Enter Your Category:</label>
            <input type="text" id="name" name="name">
            <input type="button" value="Add" onclick="insertRecord()">
        </div>
    </form>

    <div class="container">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Category-ID</th>
                    <th scope="col">Category-Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="tbody"></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            displaycat();
        });

        function insertRecord() {
            let data = {
                name: $("#name").val()
            };

            $.ajax({
                url: '../api/category/insert.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    alert('Data inserted');
                    $('#name').val("");
                    displaycat();
                },
                error: function (error) {
                    alert('Error inserting data.');
                }
            });
        }

        function displaycat() {
            $.ajax({
                url: "../api/category/display.php",
                method: "POST",
                success: function (response) {
                    let record = "";

                    if (response.category && response.category.length > 0) {
                        for (let i = 0; i < response.category.length; i++) {
                            record +=
                                `
                                <tr>
                                    <td scope="col">${response.category[i].c_id}</td>
                                    <td scope="col">${response.category[i].cname}</td>
                                    <td scope="col"><a href="./update_c.php?id=${response.category[i].c_id}">Update</a></td>
                                    <td scope="col"><a href="#" onclick="deletecat(${response.category[i].c_id})">Delete</a></td>
                                </tr>
                                `;
                        }
                    } else {
                        record += `<tr><td colspan="4" style="text-align:center;">No Records</td></tr>`;
                    }
                    $("#tbody").html(record);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }

        function deletecat(c_id) {
            $.ajax({
                url: "../api/category/delete.php",
                method: "POST",
                data: {
                    c_id: c_id
                },
                success: function (response) {
                    displaycat();
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    </script>
</body>
</html>
