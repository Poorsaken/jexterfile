<?php
include ('includes/header.php');
if (!isset($_SESSION['userid']) || !isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
?>

<h1>HELLO DASHBOARD</h1>
<h2>FOR MENUS</h2>
<a href="MenuAdd.php">Add new Menu</a>
<a href="MenuDisplay.php">View Menu</a>
<h2>Welcome, <?php echo $username , $userid; ?>!</h2>
<h2>FOR ORDERS</h2>
<a href="OrderAdd.php">Add New Order</a>
<a href="OrderDisplay.php">View Orders</a>
<a href="Logout.php">logout</a>
<?php
include ('includes/footer.php');
?>