<?php 
session_start();
include('../server/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Solid Computers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Solid Computers</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="logout.php?logout=1">Logout</a></li>
            </ul>
        </div>
    </nav>
    <!-- Side Menu -->
    <div class="side-menu">
        <a href="index.php">Orders</a>
        <a href="products.php">Products</a>
        <a href="add_product.php">Add Product</a>
        <a href="account.php">Account</a>
        <a href="help.php">Help</a>
    </div>