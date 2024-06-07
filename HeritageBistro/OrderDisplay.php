<?php
include ('includes/header.php');
include ('classes/Orders.php');
$Order = new Orders();
$OrderList = $Order->displayOrders();
?>

<div class="container">
    <h2>Orders List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($OrderList as $order) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>
                        <ul>
                            <?php foreach ($order['order_details'] as $detail) { ?>
                                <li><?php echo $detail['menu_name']; ?> - $<?php echo number_format($detail['price'], 2); ?> x
                                    <?php echo $detail['quantity']; ?> (Subtotal:
                                    $<?php echo number_format($detail['subtotal'], 2); ?>)</li>
                            <?php } ?>
                        </ul>
                    </td>
                    <td>
                        <form action="OrderDetails.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit">View</button>
                        </form>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include ('includes/footer.php');
?>