<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Desktop Computers' LIMIT 4");

$stmt->execute();

$desktops = $stmt->get_result();//[]

?>