<?php
include ('includes/header.php');
if (!isset($_SESSION['userid']) || !isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
?>



<div class="index-parent">

    <div class="left-navigation">
    <?php 
    include('./navigation/navigation.php');
    ?>

    </div>

    <div class="right-content">

        <div class="reservation-makeorder-vieworder">


       <a href="CustomerReservation.php">
         <div class="reservation-button">
       
                
               <h  class="res-title">  MAKE A RESERVATION</h>
    
    
        </div>
        </a>

       <a href="OrderAdd.php">
         <div class="reservation-button">
       
                
               <h  class="res-title">  MAKE AN ORDER</h>
    
    
        </div>
        </a>
       <a href="OrderDisplay.php">
         <div class="reservation-button">
       
                
               <h  class="res-title">  VIEW ORDERS</h>
    
    
        </div>
        </a>

       

        


        </div>
       
        <!-- <h2>Welcome, <?php echo $username , $userid; ?>!</h2>
        <h2>FOR ORDERS</h2>
        <a href="OrderAdd.php">Add New Order</a>
        <a href="OrderDisplay.php">View Orders</a>
        <a href="Logout.php">logout</a> -->

    </div>
    

</div>

<?php
include ('includes/footer.php');
?>