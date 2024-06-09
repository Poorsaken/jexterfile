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


$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
?>

<div class="index-parent">

<div class="left-navigation">
    <?php include('./navigation/navigation.php') ?>;
</div>
<div class="right-content">

       <div class="welcome-header-food" style="border-bottom: 1px solid rgba(0, 0, 0, 0.55); margin-bottom: 5px;" >
    <div class="welcome-food" >
        <h>Welcome, <?php echo $username , $userid; ?>!</h>
        <p>View your menu</p>
       
    </div>
</div>


<div class="receipt">

    <div class="order-receipt-header">

        <h>Order Details</h>
    </div>

    <div class="billedto">

        <p class="order-id">OrderID: 
            <?php echo $order['order_id']; ?></p>
        <p class="order-date">Date: 
            <?php echo $order['order_date']; ?></p>
    
        <p class="order-date">Total Amount:
          $<?php echo number_format($order['total_amount'], 2); ?></p>
    
    </div>
    


 
    <div>
    
   
 <table style="">
    <thead>
        <tr>
            <th>Menu Name</th>
            <th>Price</th>
            <th >QTY</th>
            <th>Subtotal</th>
            <th></th> <!-- Empty cell for spacing -->
            <th></th> <!-- Empty cell for spacing -->
            <th></th> <!-- Empty cell for spacing -->
            <th></th> <!-- Empty cell for spacing -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($order['order_details'] as $detail) { ?>
            <tr>
                <td class="menu-name-column"><?php echo $detail['menu_name']; ?></td>

                <td class="menu-price-column">$<?php echo number_format($detail['price'], 2); ?></td>
                <td class="menu-QTY-column"><?php echo $detail['quantity']; ?></td>
                <td>$<?php echo number_format($detail['subtotal'], 2); ?></td>
                <td></td> <!-- Empty cell for spacing -->
                <td></td> <!-- Empty cell for spacing -->
                <td></td> <!-- Empty cell for spacing -->
                <td></td> <!-- Empty cell for spacing -->
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="two-div-receipt">
    <div class="left-receipt-coloumn">

    </div>
   
    <div class="left-receipt-coloumn">
        <div class="subtotal-price">
            <div class="sub">

                <p>Sub Total: </p>
            </div>

            <div class="sub">

                $<?php echo number_format($order['total_amount'], 2); ?>
            </div>
        </div>

        <div class="subtotal-price" style =" border-bottom: 1px solid black; margin-bottom: 15px">
            <div class="sub">

                <p>Status: </p>
            </div>

            <div class="sub">

               <?php if ($order['status'] == 0) { ?>
        Pending
    <?php } else { ?>
        Received
    <?php } ?>
            </div>
        </div>

<div style="margin-right: 20px;"></div> <!-- Empty div for spacing -->
   
   
    </div>
   
</div>

 <form action="" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
        <button type="submit" name="btn" class="received-btn">Received</button>
    </form>

 


</div>

    
</div>

</div>
</div>


<?php
include ('includes/footer.php');
?>