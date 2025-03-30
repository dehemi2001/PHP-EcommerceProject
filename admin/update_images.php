<?php

include('../server/connection.php');

if(isset($_POST['update_images'])){

    $product_name = $_POST['name'];
    $product_id = $_POST['product_id'];

    // Retrieve the current image file names from the database
    $stmt = $conn->prepare("SELECT product_image, product_image2, product_image3, product_image4 FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Delete the existing images from the assets/imgs folder
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
    }

    // Handle the new images
    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];

    $image_name1 = $_FILES['image1']['name'];
    $image_name2 = $_FILES['image2']['name'];
    $image_name3 = $_FILES['image3']['name'];
    $image_name4 = $_FILES['image4']['name'];

    move_uploaded_file($image1, '../assets/imgs/'.$image_name1);
    move_uploaded_file($image2, '../assets/imgs/'.$image_name2);
    move_uploaded_file($image3, '../assets/imgs/'.$image_name3);
    move_uploaded_file($image4, '../assets/imgs/'.$image_name4);

    // Update the database with the new image file names
    $stmt = $conn->prepare("UPDATE products SET product_image = ?, product_image2 = ?, product_image3 = ?, product_image4 = ? WHERE product_id = ?");
    $stmt->bind_param("ssssi", $image_name1, $image_name2, $image_name3, $image_name4, $product_id);

    if($stmt->execute()){
        header('location: products.php?images_updated=Images have been updated successfully!');
    }else{
        header('location: products.php?images_failed=Error occurred, try again!');
    }
}

?>