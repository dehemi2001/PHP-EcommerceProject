<?php include('layouts/header.php'); ?>

<?php

if (isset($_POST["add_to_cart"])) {
    //if user has already added a product to cart
    if (isset($_SESSION["cart"])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [ 2, 3, 4, 10, 15]
        //if product has already been added to cart or noe
        if (!in_array($_POST["product_id"], $products_array_ids)) {
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][] = $product_array;

            //product has already been added
        } else {
            echo '<script>alert("Product was already added to cart")</script>';
        }

        //if this is the first product    
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][] = $product_array;
        // [ 2=>[], 3=>[], 5=>[] ]
    }

    //remove product from cart
} elseif (isset($_POST["remove_product"])) {
    $product_id_to_remove = $_POST['product_id'];

    // Check if the cart exists and is an array before attempting to iterate.
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Loop through the cart to find the product
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['product_id'] == $product_id_to_remove) {
                // Remove the product from the cart
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("Product successfully removed from cart")</script>';
                break; // Exit the loop after removing the product
            }
        }
    }
} elseif (isset($_POST["edit_quantity"])) {
    //we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    // Check if the cart exists and is an array before attempting to iterate.
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['product_id'] == $product_id) {
                // Update the quantity of the product
                $_SESSION['cart'][$key]['product_quantity'] = $product_quantity;
                break; // Exit the loop after updating the quantity
            }
        }
    }
    header('location: cart.php');
}

//calculate total
calculateTotalCart();

function calculateTotalCart()
{
    $total_price = 0;
    $total_quantity = 0;
    
    // Check if the cart exists and is an array before attempting to iterate.
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {

            $product = $_SESSION['cart'][$key];

            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total_price = $total_price + $price * $quantity;
            $total_quantity = $total_quantity + $quantity;
            
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
                ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>LKR </span><?php echo $value['product_price']; ?></small>
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
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
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