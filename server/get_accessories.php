<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Accessories' LIMIT 4");

$stmt->execute();

$accessories = $stmt->get_result();//[]

?>