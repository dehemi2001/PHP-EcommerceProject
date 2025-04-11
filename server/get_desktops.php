<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Desktop Computers' ORDER BY product_id DESC LIMIT 4");

$stmt->execute();

$desktops = $stmt->get_result();//[]

?>