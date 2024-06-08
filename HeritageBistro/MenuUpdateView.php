<?php
include ('includes/header.php');
include ('classes/Menus.php');

$Menu = new Menus();
$MenuList = $Menu->displayMenu();

if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $Menu->deleteMenu($id);
  header("Location: ".$_SERVER['PHP_SELF']);
  exit;
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

<div class="welcome-header-food" style="border-bottom: 1px solid rgba(0, 0, 0, 0.55); margin-bottom: 5px;" >
    <div class="welcome-food" >
        <h>Welcome, <?php echo $username , $userid; ?>!</h>
        <p>Here you can update and delete a menu.</p>
       
    </div>
</div>


<div class="food-flexes">
<?php foreach ($MenuList as $menu){ ?>
    
        
        <div class="food-card-body">

           <div class="food-card-image" >
    <?php if ($menu['image']) { ?>
        <img src="/JEXTERDIAYKA/jexterfile/HeritageBistro/uploaded_image/<?php echo $menu['image']; ?>" alt="User Image" class="food-rounded-circle food-img-fluid" width="100" style="object-fit: cover; width: 100%; height: 100%;">
    <?php } else { ?>
        <p>No Image</p>
    <?php } ?>
</div>



            <div class="food-descriptions">

            <h class="food-card-title"> <?php echo $menu['menu_name']; ?></h>
           
            <p class="food-card-text-price"><?php echo $menu['price']; ?></p>

            <p class="food-card-text">
              <?php echo $menu['category']; ?> </p>
          
            <div class="food-category">
                <p><strong>Description:</strong></p>
                <p class="food-card-text"><?php echo $menu['description']; ?></p>
            </div>

            <div class="food-card-actions">
                <form action="MenuUpdate.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                    <button type="submit" class="food-btn food-btn-primary">Update</button>
                </form>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                    <button type="submit" name="delete" class="food-btn food-btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                </form>
            </div>
            
            </div>

            
        </div>
    
<?php } ?>

</div>
 

    </div>


    </div>


</div>

<?php include ('includes/footer.php'); ?>
