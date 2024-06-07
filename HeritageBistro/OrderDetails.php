<?php
include ('includes/header.php');
include ('classes/Orders.php');

$Order = new Orders();
$order = $Order->getOrderById($_REQUEST['id']); // Use singular $order instead of $OrderList

// Handle button click
if (isset($_POST['btn'])) {
    $orderId = $_POST['order_id'];
    if ($Order->updateOrderStatus($orderId)) {
        // If update is successful, redirect to the same page to avoid continuous refresh
        header("Location: OrderDetails.php?id=$orderId");
        exit; // Stop further execution
    } else {
        echo "<script>alert('Something Went Wrong');</script>";
    }
}

?>

<div class="container">
    <h2>Order Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Action</th> <!-- Added Action column -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td colspan="5"></td> <!-- Empty cells for spacing -->
                <td>
                    <?php if ($order['status'] == 0) { ?>
                        Pending
                    <?php } else { ?>
                        Received
                    <?php } ?>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <button type="submit" name="btn">Received</button>
                    </form>
                </td>
            </tr>
            <?php foreach ($order['order_details'] as $detail) { ?>
                <tr>
                    <td><?php echo $detail['menu_name']; ?></td>
                    <td>$<?php echo number_format($detail['price'], 2); ?></td>
                    <td><?php echo $detail['quantity']; ?></td>
                    <td>$<?php echo number_format($detail['subtotal'], 2); ?></td>
                    <td></td> <!-- Empty cell for spacing -->
                    <td></td> <!-- Empty cell for spacing -->
                    <td></td> <!-- Empty cell for spacing -->
                    <td></td> <!-- Empty cell for spacing -->
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include ('includes/footer.php');
?>