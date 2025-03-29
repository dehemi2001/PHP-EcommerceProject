<?php include('layouts/header.php'); ?>

<!--Home-->
<section id="home">
  <div class="container">
    <h5>NEW ARRIVALS</h5>
    <h1><span>Best Prices</span> This Season</h1>
    <p>Eshop offers the best products for the most affordable prices</p>
    <a href="shop.php"><button>Shop Now</button></a>
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
        <a href="index.php#laptops"><button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
    <!-- Two -->
    <div class="one col-lg-4 col-md-6 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/2.jpeg">
      <div class="details">
        <h2>Awesome Desktops</h2>
        <a href="index.php#desktops"><button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
    <!-- Three -->
    <div class="one col-lg-4 col-md-6 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.jpeg">
      <div class="details">
        <h2>50% OFF Accessories</h2>
        <a href="index.php#accessories"><button class="text-uppercase">Shop Now</button></a>
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

    <?php while ($row = $featured_products->fetch_assoc()) { ?>

      <div onclick="window.location.href='<?php echo "single_product.php?product_id=" . $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <div class="product-image mb-3" style="background-image: url('assets/imgs/<?php echo $row['product_image']; ?>');"></div>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    <?php } ?>
  </div>
</section>

<!--Banner-->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4 style="color:white">MID SEASON'S SALE</h4>
    <h1>Autumn Collection <br> UP to 30% OFF</h1>
    <a href="shop.php"><button class="text-uppercase">shop now</button></a>
  </div>
</section>

<!--Desktops-->
<section id="desktops" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Desktop Computers</h3>
    <hr class="mx-auto">
    <p>Here you can check out our Desktop Computers</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_desktops.php') ?>

    <?php while ($row = $desktops->fetch_assoc()) { ?>

      <div onclick="window.location.href='<?php echo "single_product.php?product_id=" . $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <div class="product-image mb-3" style="background-image: url('assets/imgs/<?php echo $row['product_image']; ?>');"></div>
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

<!--Laptops-->
<section id="laptops" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Laptop Computers</h3>
    <hr class="mx-auto">
    <p>Here you can check out our Laptop Computers</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_laptops.php') ?>

    <?php while ($row = $laptop_products->fetch_assoc()) { ?>

      <div onclick="window.location.href='<?php echo "single_product.php?product_id=" . $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <div class="product-image mb-3" style="background-image: url('assets/imgs/<?php echo $row['product_image']; ?>');"></div>
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
<section id="accessories" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Accessories</h3>
    <hr class="mx-auto">
    <p>Here you can check out our Accesorries</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_accessories.php') ?>

    <?php while ($row = $accessories->fetch_assoc()) { ?>

      <div onclick="window.location.href='<?php echo "single_product.php?product_id=" . $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <div class="product-image mb-3" style="background-image: url('assets/imgs/<?php echo $row['product_image']; ?>');"></div>
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

<?php include('layouts/footer.php'); ?>