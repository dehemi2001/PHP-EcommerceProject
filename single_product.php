<?php

include('layouts/header.php');

include('server/connection.php');


if (isset($_GET['product_id'])) {

  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

  $stmt->bind_param("i", $product_id);

  $stmt->execute();

  $product = $stmt->get_result(); //[]

  $row = $product->fetch_assoc();

  $product_category = $row['product_category'];

  //no product id was given
} else {
  header('Location:index.php');
}

?>

<!--Single Product-->
<section class="container single-product my-5 pt-5">
  <div class="row mt-5">

    <div class="col-lg-5 col-md-6 col-sm-12">
      <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg">
      <div class="small-img-group">
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
        </div>
        <div class="small-img-col">
          <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img">
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-12 col-12">
      <h6><?php echo $row['product_category']; ?></h6>
      <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
      <?php if ($row['product_special_offer'] > 0) { ?>
        <h5 class="text-danger">Special Offer: <?php echo $row['product_special_offer']; ?>%</h5>
      <?php } ?>
      <h2>LKR <?php echo $row['product_price']; ?></h2>
      <h5>Product Color: <?php echo $row['product_color']; ?></h5>
      <h5>Stock Quantity: <?php echo $row['stock_quantity']; ?></h5>

      <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
        <input type="hidden" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>">
        <input type="number" name="product_quantity" value="1" min="1" max="<?php echo $row['stock_quantity']; ?>">
        <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
      </form>

      <h4 class="mt-5 mb-5">Product Details</h4>
      <div class="product-details">
        <?php echo nl2br($row['product_description']); ?>
      </div>
    </div>

  </div>
</section>


<!--Related Products-->
<section id="related-products" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Related Products</h3>
    <hr class="mx-auto">
  </div>
  <div class="row mx-auto container-fluid">

    <?php if ($product_category == 'Laptop Computers') { ?>

      <?php include('server/get_featured_products.php') ?>

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

    <?php } elseif ($product_category == 'Desktop Computers') { ?>

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

    <?php } elseif ($product_category == 'Accessories') { ?>

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

    <?php } ?>

  </div>
</section>

<script>
  var mainImg = document.getElementById("mainImg");
  var smallImg = document.getElementsByClassName("small-img");

  for (let i = 0; i < 4; i++) {
    smallImg[i].onclick = function() {
      mainImg.src = smallImg[i].src;
    }
  }
</script>

<?php include('layouts/footer.php'); ?>