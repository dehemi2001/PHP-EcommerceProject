<?php
session_start();

if (isset($_POST["add_to_cart"])) {

    //if user has already added a product to cart
    if (isset($_SESSION["cart"])) {

        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [ 2, 3, 4, 10, 15]
        //if product has already been added to cart or noe
        if (!in_array($_POST["product_id"], $products_array_ids)) {

            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][] = $product_array;

            //product has already been added
        } else {
            echo '<script>alert("Product was already added to cart")</script>';
        }

        //if this is the first product    
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][] = $product_array;
        // [ 2=>[], 3=>[], 5=>[] ]
    }
//remove product from cart
} elseif(isset($_POST["remove_product"])){

    $product_id_to_remove = $_POST['product_id'];

    // Loop through the cart to find the product
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id_to_remove) {
            // Remove the product from the cart
            unset($_SESSION['cart'][$key]);
            echo '<script>alert("Product successfully removed from cart")</script>';
            break; // Exit the loop after removing the product
        }
    }
}

else {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">

        <div class="container">
            <img class="logo" src="assets/imgs/Untitled-1.png">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="account.html"><i class="fa-solid fa-user"></i></a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>LKR </span><?php echo $value['product_price']; ?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="remove">
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="number" value="<?php echo $value['product_quantity']; ?>">
                        <a class="edit-btn" href="#">Edit</a>
                    </td>
                    <td>
                        <span>LKR</span>
                        <span class="product-price">400000</span>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>LKR 1200000</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>LKR 1200000</td>
                </tr>
            </table>
        </div>

        <div class="text-end mt-3">
            <button class="buy-btn checkout-btn">Checkout</button>
        </div>
    </section>

    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/Untitled-1.png">
                <p class="pt-3">We provide the best products for the most affordable prices</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">Featured</a></li>
                    <li><a href="#">Desktops</a></li>
                    <li><a href="#">Laptops</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">Discounts</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>444 Puttalam - Colombo Rd, Negombo</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>0312 228 182</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>solidcomputers@outlook.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-12">Facebook</h5>
                <div class="row">
                    <img src="assets/imgs/featured1.png" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/featured2.jpg" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/featured3.jpg" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/featured4.jpg" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/desktop1.jpg" class="img-fluid w-25 h-100 m-2">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                    <img src="assets/imgs/payment.png">
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <p>eCommerce @ 2025 All Right Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>