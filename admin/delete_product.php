<?php

session_start();

include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Retrieve the image file names from the database
    $stmt = $conn->prepare("SELECT product_image, product_image2, product_image3, product_image4 FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Delete the images from the assets/imgs folder
        $image_paths = [
            '../assets/imgs/' . $product['product_image'],
            '../assets/imgs/' . $product['product_image2'],
            '../assets/imgs/' . $product['product_image3'],
            '../assets/imgs/' . $product['product_image4']
        ];

        foreach ($image_paths as $path) {
            if (file_exists($path)) {
                unlink($path); // Delete the file
            }
        }

        // Delete the product record from the database
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            header('Location: products.php?delete_success_message=Product and its images have been deleted successfully');
        } else {
            header('Location: products.php?delete_failure_message=Could not delete product');
        }
    } else {
        header('Location: products.php?delete_failure_message=Product not found');
    }
}
?>
