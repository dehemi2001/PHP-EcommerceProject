<?php 
include('header.php');
?>


    <div class="content">
        <h2>Create Product</h2>
        <form action="create_product.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" required step="0.01" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Special Offer/Sale</label>
                <input type="number" name="offer" class="form-control" required step="0.01" min="0" max="100">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="Laptop Computers">Laptop Computers</option>
                    <option value="Desktop Computers">Desktop Computers</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Color</label>
                <input type="text" name="color" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Stock Quantity</label>
                <input type="number" min=0 name="stock_quantity" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Image 1</label>
                <input type="file" name="image1" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Image 2</label>
                <input type="file" name="image2" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Image 3</label>
                <input type="file" name="image3" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Image 4</label>
                <input type="file" name="image4" class="form-control">
            </div>
            <button type="submit" name="create_product" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>
</html>