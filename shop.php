<?php

include('server/connection.php');

//use the search section
if (isset($_POST['search'])) {

    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? ");

    $stmt->bind_param('si', $category, $price);

    $stmt->execute();

    $products = $stmt->get_result(); //[]

    //return all products
} else {

    $stmt = $conn->prepare("SELECT * FROM products");

    $stmt->execute();

    $products = $stmt->get_result(); //[]

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

    <style>
        .pagination a {
            color: coral;
        }

        .pagination li:hover a {
            color: #fff;
            background-color: coral;
        }

        /* Add styles to arrange search on the left side */
        #shop-content {
            display: flex;
            gap: 20px;
            /* Add some space between the search and product sections */
            margin-top: 100px;
        }

        #search {
            width: 25%;
            /* Adjust the width as needed */
            flex-shrink: 0;
            /* Prevent the search section from shrinking */
        }

        #featured {
            width: 75%;
            /* Adjust the width as needed */

        }

        .section-title {
            margin-top: 30px;
        }
    </style>
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
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="account.html"><i class="fa-solid fa-user"></i></a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

    <!--Search-->
    <div id="shop-content" class="container my-5 pt-5">
        <section id="search" class="ms-2">
            <p class="section-title">Search Products</p>
            <hr>

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Category</p>
                        <div class="form-check">
                            <input class="form-check-input" value="Laptop Computers" type="radio" name="category" id="category_one">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Laptops
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" value="Desktop Computers" type="radio" name="category" id="category_two" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Desktops
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" value="Accessories" type="radio" name="category" id="category_two" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Accessories
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Price</p>
                        <input type="range" class="form-range w-50" name="price" value="100000" min="1" max="1000000" id="customRange2">
                        <div class="w-50">
                            <span style="float: left;">1</span>
                            <span style="float: right;">1000000</span>
                        </div>
                    </div>
                </div>

                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                </div>
            </form>
        </section>

        <!--Shop-->
        <section id="featured">
            <h3 class="section-title">Our Products</h3>
            <hr>
            <p>Here you can check out our featured products</p>
            <div class="row mx-auto container">

                <?php while ($row = $products->fetch_assoc()) { ?>

                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                        <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                        <a class="btn shop-buy-btn" href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">Buy Now</a>
                    </div>

                <?php } ?>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <?php include('layouts/footer.php'); ?>