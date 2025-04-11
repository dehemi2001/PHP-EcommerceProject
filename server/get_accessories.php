<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Accessories' ORDER BY product_id DESC LIMIT 4");

$stmt->execute();

$accessories = $stmt->get_result();//[]

?>