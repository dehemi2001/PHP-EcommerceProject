<?php

include('header.php');

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    
}else{
    header('location: products.php');
}
?>

<div class="container mt-5" style="margin-left: 220px; padding-top: 30px;">
    <h2 class="mt-4">Update Product Images</h2>
    <form action="update_images.php" method="POST" enctype="multipart/form-data" class="mt-3">

        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
        
        <div class="mb-3">
            <label for="image1" class="form-label">Image 1</label>
            <input type="file" class="form-control" id="image1" name="image1">
        </div>
        
        <div class="mb-3">
            <label for="image2" class="form-label">Image 2</label>
            <input type="file" class="form-control" id="image2" name="image2">
        </div>

        <div class="mb-3">
            <label for="image3" class="form-label">Image 3</label>
            <input type="file" class="form-control" id="image3" name="image3">
        </div>

        <div class="mb-3">
            <label for="image4" class="form-label">Image 4</label>
            <input type="file" class="form-control" id="image4" name="image4">
        </div>

        <input type="submit" class="btn btn-primary" name="update_images" value="Update">
    </form>
</div>

</body>
</html>