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
            <a class="nav-link" href="index.html">Home</a>
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

  <!--Home-->
  <section id="home">
    <div class="container">
      <h5>NEW ARRIVALS</h5>
      <h1><span>Best Prices</span> This Season</h1>
      <p>Eshop offers the best products for the most affordable prices</p>
      <button>Shop Now</button>
    </div>
  </section>

  <!--Brand-->
  <section id="brand" class="container">
    <div class="row">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.png">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.png">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.png">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png">
    </div>
  </section>

  <!-- New -->
  <section id="new" class="w-100">
    <div class="row p-0 m-0">
      <!-- One -->
      <div class="one col-lg-4 col-md-6 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/1.jpeg">
        <div class="details">
          <h2>Extremely Awesome Laptops</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
      <!-- Two -->
      <div class="one col-lg-4 col-md-6 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/2.jpeg">
        <div class="details">
          <h2>Awesome Desktops</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
      <!-- Three -->
      <div class="one col-lg-4 col-md-6 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/3.jpeg">
        <div class="details">
          <h2>50% OFF Accessories</h2>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </div>
    </div>
  </section>

  <!--Featured-->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Our Featured</h3>
      <hr class="mx-auto">
      <p>Here you can check out our featured products</p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php include('server/get_featured_products.php') ?>

      <?php while($row= $featured_products->fetch_assoc()){ ?>

      <div onclick="window.location.href='<?php echo "single_product.php?product_id=". $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php } ?>
    </div>
      
  </section>

   <!--Laptops-->
   <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Our Laptop Computers</h3>
      <hr class="mx-auto">
      <p>Here you can check out our Laptop Computers</p>
    </div>
    <div class="row mx-auto container-fluid">

    <?php include('server/get_laptops.php') ?>

    <?php while($row=$laptop_products->fetch_assoc()){ ?>

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
        <button class="buy-btn">Buy Now</button>
      </div>
    <?php } ?>
    </div>
  </section>

   <!--Accessories-->
   <section id="featured" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>Our Accessories</h3>
      <hr class="mx-auto">
      <p>Here you can check out our Accesorries</p>
    </div>
    <div class="row mx-auto container-fluid">
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/accessorie1.jpg">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Keyboard</h5>
        <h4 class="p-price">LKR 400000</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/accessorie2.jpg">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Mouse</h5>
        <h4 class="p-price">LKR 50000</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/accessorie3.jpg">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Monitor</h5>
        <h4 class="p-price">LKR 60000</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/accessorie4.png">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Speakers</h5>
        <h4 class="p-price">LKR 300000</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
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