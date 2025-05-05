<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "Not Paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, order_phone, order_city, order_address, order_date, user_id)
                                VALUES (?, ?, ?, ?, ?, ?, ?); ");
        $stmt->bind_param('isssssi', $order_cost, $order_status, $phone, $city, $address, $order_date, $user_id);

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

        //5. Send an email to the user with order details

        $stmt = $conn->prepare("SELECT * FROM admins LIMIT 1");
        $stmt->execute();
        $admins = $stmt->get_result();
        $admin = $admins->fetch_assoc();

        $admin_email = $admin['admin_email'];
        $app_password = $admin['app_password'];
        $user_email = $_SESSION['user_email'];

        require '../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = $admin_email;
        $mail->Password = $app_password;
        $mail->setFrom($admin_email, "Solid Computers");
        $mail->addAddress($user_email);
        $mail->Subject = 'Order Confirmation for Order ID: ' . $order_id;
        $mail->msgHTML("
            <html>
            <head>
            <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }
            .email-container {
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            .email-header {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .email-body {
                margin-bottom: 20px;
            }
            .email-footer {
                font-size: 12px;
                color: #555;
            }
            </style>
            </head>
            <body>
            <div class='email-container'>
            <div class='email-header'>Order Confirmation</div>
            <div class='email-body'>
                Dear Customer,<br><br>
                Thank you for shopping with us. Your order has been placed successfully.<br><br>
                <strong>Order Details:</strong><br>
                <ul>
                <li><strong>Order ID:</strong> $order_id</li>
                <li><strong>Total Amount:</strong> LKR $order_cost</li>
                </ul>
                We appreciate your business and look forward to serving you again.<br><br>
                Best regards,<br>
                Solid Computers
            </div>
            <div class='email-footer'>
                This is an automated message. Please do not reply to this email.
            </div>
            </div>
            </body>
            </html>
        ");
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // Email sent successfully
        }

        //6. Send an email to the admin with order details
        $admin_email = 'dp.dehemisuvipul@gmail.com'; // Use your admin email
        $mail->clearAddresses(); // Clear previous recipients
        $mail->addAddress($admin_email);
        $mail->Subject = 'New Order Received (Order ID: ' . $order_id . ')';
        $mail->msgHTML("
            <html>
            <head>
            <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }
            .email-container {
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            .email-header {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .email-body {
                margin-bottom: 20px;
            }
            .email-footer {
                font-size: 12px;
                color: #555;
            }
            </style>
            </head>
            <body>
            <div class='email-container'>
            <div class='email-header'>New Order Notification</div>
            <div class='email-body'>
                A new order has been placed.<br><br>
                <strong>Order Details:</strong><br>
                <ul>
                <li><strong>Order ID:</strong> $order_id</li>
                <li><strong>Total Amount:</strong> LKR $order_cost</li>
                </ul>
                <strong>Customer Details:</strong><br>
                <ul>
                <li><strong>Email:</strong> $user_email</li>
                <li><strong>Phone:</strong> $phone</li>
                <li><strong>Address:</strong> $address</li>
                </ul>
                Please process the order at your earliest convenience.<br>
            </div>
            <div class='email-footer'>
                This is an automated message. Please do not reply to this email.
            </div>
            </div>
            </body>
            </html>
        ");
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // Email sent successfully
        }

        //7. Clear the cart
        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);

        //8. Inform the user that the order was placed successfully
        header('location: ../payment.php?order_status=order placed successfully');
    }
}