<?php

include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

//1. determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user has already entered page then page number is one that they selected
    $page_no = $_GET['page_no'];
} else {
    //if user just entered the page then defualt page is 1
    $page_no = 1;
}

//2. return number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM order_items");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

//3. products per page
$total_records_per_page = 8;

$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4. get all products

// $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
$stmt2 = $conn->prepare("SELECT 
    p.product_id,
    p.product_image,
    p.product_name,
    p.product_category,
    p.product_color,
    oi.product_quantity
FROM 
    products p
JOIN 
    order_items oi ON p.product_id = oi.product_id
    WHERE oi.order_id = ?
    LIMIT $offset, $total_records_per_page");
$order_id = $_GET['order_id'];
$stmt2->bind_param("i", $order_id);
$stmt2->execute();
$orders = $stmt2->get_result();

?>

<div class="main-content">
    <h4 class="mt-5">Order</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product Id</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Product Color</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['product_id'] ?></td>
                    <td><img src="../assets/imgs/<?php echo $order['product_image']; ?>" style="width: 70px; height: 70px"></td>
                    <td><?php echo $order['product_name'] ?></td>
                    <td><?php echo $order['product_category'] ?></td>
                    <td><?php echo $order['product_color'] ?></td>
                    <td><?php echo $order['product_quantity'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <li class="page-item <?php if ($page_no <= 1) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page_no <= 1) {
                                                echo '#';
                                            } else {
                                                echo "?page_no=" . ($page_no - 1);
                                            } ?>">Previous</a>
            </li>

            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

            <?php if ($page_no >= 3) { ?>
                <li class="page-item"><a class="page-link" href="">...</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
            <?php } ?>

            <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                                echo '#';
                                            } else {
                                                echo "?page_no=" . ($page_no + 1);
                                            } ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>