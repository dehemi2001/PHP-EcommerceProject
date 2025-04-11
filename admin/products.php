<?php
include("header.php");

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
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
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
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

$stmt2 = $conn->prepare("SELECT * FROM products ORDER BY product_id DESC LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

?>

<!-- Main Content -->
<div class="main-content">
    <h4 class="mt-5">Products</h4>

    <?php if(isset($_GET['edit_success_message'])) { ?>
        <p class="text_center" style="color: green"><?php echo $_GET['edit_success_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['edit_failure_message'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['edit_failure_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['delete_success_message'])) { ?>
        <p class="text_center" style="color: green"><?php echo $_GET['delete_success_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['delete_failure_message'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['delete_failure_message']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['product_created'])) { ?>
        <p class="text_center" style="color: green"><?php echo $_GET['product_created']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['product_failed'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['product_failed']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['images_updated'])) { ?>
        <p class="text_center" style="color: green"><?php echo $_GET['images_updated']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['images_failed'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['images_failed']; ?></p>
    <?php } ?>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product Id</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Offer</th>
                <th>Product Category</th>
                <th>Product Color</th>
                <th>Stock Quantity</th>
                <th>Edit Images</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($products as $product){ ?>
            <tr>
                <td><?php echo $product['product_id'] ?></td>
                <td><img src="../assets/imgs/<?php echo $product['product_image']; ?>" style="width: 70px; height: 70px"></td>
                <td><?php echo $product['product_name'] ?></td>
                <td>LKR <?php echo $product['product_price'] ?></td>
                <td><?php echo $product['product_special_offer'] ?>%</td>
                <td><?php echo $product['product_category'] ?></td>
                <td><?php echo $product['product_color'] ?></td>
                <td><?php echo $product['stock_quantity'] ?></td>
                <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Edit Images</a></td>
                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
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