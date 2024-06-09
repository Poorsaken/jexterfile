<?php
include ('includes/header.php');
include ('classes/Menus.php');

$Menu = new Menus();
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $MenuList = $Menu->getMenuById($_REQUEST['id']);
    if ($MenuList) {
        foreach ($MenuList as $menu) {
            $menu_name = $menu['menu_name'];
            $category = $menu['category'];
            $price = $menu['price'];
            $description = $menu['description'];
        }
    } else {
        echo "<script>alert('Error Updating Menu');</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_name = $_POST['menu_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $Menu->updateMenu($_REQUEST['id'], $menu_name, $category, $price, $description);

    header('Location: MenuDisplay.php');
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



<div class="container">
    <form action="" method="POST" id="myForm" enctype="multipart/form-data">
        <div class="parent">
            <!-- Menu Name -->

            <div class="welcome-header">

                <div class="welcome">
                    <h>Welcome, <?php echo $username , $userid; ?>!</h> 
                    <p> How's your day?</p>

                </div>
            </div>

            <div class="menu-form">
 <div class="parent-flex">

        <div class="addmenu">

            
            <h1><img src='img/clarity_update-line.png' alt=''>Update A Menu</h1>
            <p>Add a delicious new dish to our menu and delight our customers with every bite!</p>
        </div>
 
 </div>
               
                <label for="menu_name">Menu Name</label> <br/>
                <input type="text" id="menu_name" name="menu_name" value="<?php echo htmlspecialchars($menu_name); ?>"
                    required>
            <!-- Category Selection -->
            <div class="parent-flex">
                <div class="left-container">
                    
                    <label for="category">Category</label><br />

                    <div class="category-container">
                    <div class="left-category">

                    
                    <input type="radio" id="maindish" name="category" value="Main Dish" <?php echo ($category == 'Main Dish') ? 'checked' : ''; ?> required>
                    <label for="maindish">Main Dish</label><br>
                    <input type="radio" id="soup" name="category" value="Soup" <?php echo ($category == 'Soup') ? 'checked' : ''; ?> required>
                    <label for="soup">Soup</label><br>
                    <input type="radio" id="salad" name="category" value="Salad" <?php echo ($category == 'Salad') ? 'checked' : ''; ?> required>
                    <label for="salad">Salad</label><br>
                   
                    
                    </div>
                    <div class="right-category">

                       <input type="radio" id="appetizer" name="category" value="Appetizer" <?php echo ($category == 'Appetizer') ? 'checked' : ''; ?> required>
                    <label for="appetizer">Appetizer</label><br>
                    <input type="radio" id="dessert" name="category" value="Dessert" <?php echo ($category == 'Dessert') ? 'checked' : ''; ?> required>
                    <label for="dessert">Dessert</label><br><br>
                    </div>
                    </div>
                    
                  
                </div>
            </div>

            <div id="price-image">

                <div class="parent-flex">
                    <label for="price">Price:</label> <br/>
                    <input type="text" id="price" name="price" class="price" value="<?php echo htmlspecialchars($price); ?>"
                    required>
                </div>

                <div class="parent-flex">
                   <label for="menu_image">Insert Image:</label><br/>
                    <input type="file" id="menu_image" name="menu_image" class="menu_image" required><br>
                </div>


                 
            </div>

           
          <div id="description-parent">
               <label for="description">Description</label><br/>
                <input type="text" id="description" name="description" class="description"
                    value="<?php echo htmlspecialchars($description); ?>" required>
            </div>

            <!-- Product Description and Image -->
            <div class="parent-flex">
                <div class="left-container">
                    <!-- Insert Image -->
                    
                    <button name="btn" id="btn" class="addmenubtn">Add Menu</button>
                </div>
            </div>

            </div>
           
        </div>
    </form>
</div>











</div>
</div>


    

<?php include ('includes/footer.php'); ?>