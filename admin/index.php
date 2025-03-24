<?php
include("header.php");

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
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
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

$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();

?>

<!-- Main Content -->
<div class="main-content">
    <h2 class="mb-3">Dashboard</h2>
    <h4>Orders</h4>

    <?php if(isset($_GET['order_updated'])) { ?>
        <p class="text_center" style="color: green"><?php echo $_GET['order_updated'] ?></p>
    <?php } ?>

    <?php if(isset($_GET['order_failed'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['order_failed'] ?></p>
    <?php } ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order Id</th>
                <th>Order Status</th>
                <th>User Id</th>
                <th>Order Date</th>
                <th>User Phone</th>
                <th>User Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($orders as $order){ ?>
            <tr>
                <td><?php echo $order['order_id'] ?></td>
                <td><?php echo $order['order_status'] ?></td>
                <td><?php echo $order['user_id'] ?></td>
                <td><?php echo $order['order_date'] ?></td>
                <td><?php echo $order['user_phone'] ?></td>
                <td><?php echo $order['user_address'] ?></td>
                <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id'] ?>">Edit</a></td>
                <td><a class="btn btn-danger">Delete</a></td>
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