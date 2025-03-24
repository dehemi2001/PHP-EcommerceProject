<?php
include('header.php');

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['product_offer'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_special_offer=?, product_color=?, product_category=? WHERE product_id=?");
    $stmt->bind_param('ssssssi', $title, $description, $price, $offer, $color, $category, $product_id);

    if($stmt->execute()){
        header('Location: products.php?edit_success_message=Product has been updated successfully');
    }else{
        header('Location: products.php?edit_failure_message=Could not update product');
    }

}
else {
    header('Location: products.php');
}

?>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h2 class="mb-4">Edit Product</h2>
            <form method="POST" action="edit_product.php">
                <div class="mb-3">

                    <input name="product_id" type="hidden" value="<?php echo $product['product_id']; ?>">

                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" value="<?php echo $product['product_name']; ?>" name="title" placeholder="Title">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" value="<?php echo $product['product_description']; ?>" name="description" placeholder="Description">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" value="<?php echo $product['product_price']; ?>" name="price" placeholder="Price">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option <?php if ($product['product_category'] == 'Laptop Computers') echo 'selected'; ?>>Laptop Computers</option>
                        <option <?php if ($product['product_category'] == 'Desktop Computers') echo 'selected'; ?>>Desktop Computers</option>
                        <option <?php if ($product['product_category'] == 'Accessories') echo 'selected'; ?>>Accessories</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="color" value="<?php echo $product['product_color']; ?>" name="color" placeholder="Color">
                </div>

                <div class="mb-3">
                    <label for="sale" class="form-label">Special Offer/Sale</label>
                    <input type="text" class="form-control" id="product_offer" value="<?php echo $product['product_special_offer']; ?>" name="product_offer" placeholder="Sale %">
                </div>

                <button type="submit" class="btn btn-primary" name="edit_btn">Edit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>