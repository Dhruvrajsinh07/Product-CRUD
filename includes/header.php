<?php
session_start(); 

if(!isset($_SESSION['loggedIn'])){
    header("Location: /product-crud/pages/index.php");
    exit;
}
?>
