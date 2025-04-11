<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Laptop Computers' ORDER BY product_id DESC LIMIT 4");

$stmt->execute();

$laptop_products = $stmt->get_result();//[]

?>