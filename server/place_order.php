<?php

session_start();

include('connection.php');

//if user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;

    //if user is logged in
} else {

    if (isset($_POST['place_order'])) {

        //1. Validate stock for all products in the cart
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_quantity = $product['product_quantity'];

            // Check if stock quantity is sufficient
            $stmt_check = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id = ?");
            $stmt_check->bind_param('i', $product_id);
            $stmt_check->execute();
            $stmt_check->bind_result($stock_quantity);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($stock_quantity < $product_quantity) {
                // Redirect to the cart page with an error message if stock is insufficient
                header('location: ../cart.php?error=Insufficient stock for product ID: ' . $product_id);
                exit;
            }
        }

        //2. If stock is sufficient, insert order into the orders table
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "Not Paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                                VALUES (?, ?, ?, ?, ?, ?, ?); ");
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

        $stmt_status = $stmt->execute();

        if (!$stmt_status) {
            header('location: index.php');
            exit;
        }

        //3. Get the newly created order ID
        $order_id = $stmt->insert_id;

        //4. Insert each product from the cart into the order_items table and update stock
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_quantity = $product['product_quantity'];
            $stock_quantity = $product['stock_quantity'];

            // Update stock quantity in the products table
            $new_stock_quantity = $stock_quantity - $product_quantity;
            $stmt2 = $conn->prepare("UPDATE products SET stock_quantity = ? WHERE product_id = ?; ");
            $stmt2->bind_param('ii', $new_stock_quantity, $product_id);
            $stmt2->execute();

            // Insert product into the order_items table
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_quantity)
                            VALUES (?, ?, ?); ");
            $stmt1->bind_param('iii', $order_id, $product_id, $product_quantity);
            $stmt1->execute();
        }

        //5. Inform the user that the order was placed successfully
        header('location: ../payment.php?order_status=order placed successfully');
    }
}
