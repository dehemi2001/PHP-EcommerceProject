<?php include('layouts/header.php'); ?>

<?php
include('server/connection.php'); // Ensure the database connection is included

if (isset($_POST["add_to_cart"])) {
    // Fetch stock_quantity from the database
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($stock_quantity);
    $stmt->fetch();
    $stmt->close();

    if ($stock_quantity > 0) {
        // If user has already added a product to the cart
        if (isset($_SESSION["cart"])) {
            $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [ 2, 3, 4, 10, 15]
            // If product has not been added to the cart yet
            if (!in_array($product_id, $products_array_ids)) {
                $product_array = array(
                    'product_id' => $product_id,
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity'],
                    'stock_quantity' => $stock_quantity
                );

                $_SESSION['cart'][] = $product_array;
            } else {
                echo '<script>alert("Product was already added to cart")</script>';
            }
        } else {
            // If this is the first product being added to the cart
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity'],
                'stock_quantity' => $stock_quantity
            );

            $_SESSION['cart'][] = $product_array;
        }
    } else {
        echo '<script>alert("Product is out of stock")</script>';
    }
}

// Remove product from cart
elseif (isset($_POST["remove_product"])) {
    $product_id_to_remove = $_POST['product_id'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['product_id'] == $product_id_to_remove) {
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("Product successfully removed from cart")</script>';
                break;
            }
        }
    }
}

// Edit product quantity
elseif (isset($_POST["edit_quantity"])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['product_id'] == $product_id) {
                $_SESSION['cart'][$key]['product_quantity'] = $product_quantity;
                break;
            }
        }
    }
    header('location: cart.php');
}

// Calculate total
calculateTotalCart();

function calculateTotalCart()
{
    $total_price = 0;
    $total_quantity = 0;

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total_price += $price * $quantity;
            $total_quantity += $quantity;
        }
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}
?>

<!--Cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>

    <?php if(isset($_GET['error'])) { ?>
        <p class="text_center" style="color: red"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php
        // Check if the cart exists and is an array before attempting to iterate.
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $key => $value) {
                // Fetch the latest stock_quantity from the database
                $stmt = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id = ?");
                $stmt->bind_param("i", $value['product_id']);
                $stmt->execute();
                $stmt->bind_result($latest_stock_quantity);
                $stmt->fetch();
                $stmt->close();

                // Update the stock_quantity in the session
                $_SESSION['cart'][$key]['stock_quantity'] = $latest_stock_quantity;
                ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>LKR </span><?php echo $value['product_price']; ?></small>
                                <small>Stock Quantity: <?php echo $latest_stock_quantity; ?></small>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="remove">
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1" max="<?php echo $latest_stock_quantity; ?>">
                            <input type="submit" class="edit-btn" value="edit" name="edit_quantity">
                        </form>
                    </td>
                    <td>
                        <span>LKR</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>
                <?php
            }
        } else {
            // Display a message when the cart is empty
            echo '<tr><td colspan="3" class="text-center">The cart is empty</td></tr>';
        }
        ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>LKR <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : 0; ?></td>
            </tr>
        </table>
    </div>

    <div class="text-end mt-3">
        <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <form method="POST" action="checkout.php">
                <button type="submit" class="buy-btn checkout-btn" name="checkout">Checkout</button>
            </form>
        <?php } ?>
    </div>
</section>

<?php include('layouts/footer.php'); ?>