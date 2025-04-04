<?php 
include('header.php');

if (isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

}elseif(isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if($stmt->execute()){
        header('Location: index.php?order_updated=Order has been updated successfully');
    }else{
        header('Location: products.php?order_failed=Could not update order');
    }

}else{
    header('Location: index.php');
    exit();
}

?>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h2 class="mb-4">Edit Order</h2>
            <form method="POST" action="edit_order.php">
                <div class="mb-3">
                    <label for="order_id" class="form-label">Order ID</label>
                    <input type="text" value="<?php echo $order['order_id']; ?>" class="form-control" id="order_id" placeholder="#" readonly>
                </div>

                <div class="mb-3">
                    <label for="order_price" class="form-label">Order Price</label>
                    <input type="text" value="<?php echo $order['order_cost']; ?>" class="form-control" id="order_price" placeholder="#" readonly>
                </div>

                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

                <div class="mb-3">
                    <label for="order_status" class="form-label">Order Status</label>
                    <select class="form-select" id="order_status" required name="order_status">
                        <option <?php if($order['order_status'] == 'Not Paid'){echo"selected";} ?>>Not Paid</option>
                        <option <?php if($order['order_status'] == 'Paid'){echo"selected";} ?>>Paid</option>
                        <option <?php if($order['order_status'] == 'Shipped'){echo"selected";} ?>>Shipped</option>
                        <option <?php if($order['order_status'] == 'Delivered'){echo"selected";} ?>>Delivered</option>
                        <option <?php if($order['order_status'] == 'Cancelled'){echo"selected";} ?>>Cancelled</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="order_date" class="form-label">Order Date</label>
                    <input type="text" value="<?php echo $order['order_date']; ?>" class="form-control" id="order_date" placeholder="#" readonly>
                </div>

                <button type="submit" class="btn btn-primary" name="edit_order">Edit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
