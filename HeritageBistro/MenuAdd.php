<?php
include ('includes/header.php');
include ('classes/Menus.php');
$Menu = new Menus();

if (isset($_POST['btn'])) {
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $Menu->addMenu($_POST, $_FILES['menu_image']);
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

            
            <h1><img src='img/fluent_food-32-regular.png' alt=''> Add Menu</h1>
            <p>Add a delicious new dish to our menu and delight our customers with every bite!</p>
        </div>
 
 </div>
               
                <label for="menu_name">Menu Name</label> <br/>
                <input type="text" id="menu_name" name="menu_name" required>
            <!-- Category Selection -->
            <div class="parent-flex">
                <div class="left-container">
                    
                    <label for="category">Category</label><br />

                    <div class="category-container">
                    <div class="left-category">

                        <input type="radio" id="maindish" name="category" value="Main Dish" required>
                        <label for="maindish">Main Dish</label><br>
                        <input type="radio" id="soup" name="category" value="Soup" required>
                        <label for="souporsalad">Soup </label><br>
                        <input type="radio" id="salad" name="category" value="Salad" required>
                        <label for="souporsalad">Salad </label><br>
                    
                    </div>
                    <div class="right-category">

                        <input type="radio" id="appetizer" name="category" value="Appetizer" required>
                    <label for="appetizer">Appetizer</label><br>
                    <input type="radio" id="dessert" name="category" value="Dessert" required>
                    <label for="dessert">Dessert</label><br><br>
                    </div>
                    </div>
                    
                  
                </div>
            </div>

            <div id="price-image">

                <div class="parent-flex">
                    <label for="price">Price:</label> <br/>
                    <input type="text" id="price" name="price" class="price" required>
                </div>

                <div class="parent-flex">
                   <label for="menu_image">Insert Image:</label><br/>
                    <input type="file" id="menu_image" name="menu_image" class="menu_image" required><br>
                </div>


                 
            </div>

           
          <div id="description-parent">
                <label for="description">Description</label><br/>
                <textarea id="description" name="description" class="description" required></textarea>
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



<?php
include ('includes/footer.php');
?>
