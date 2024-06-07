<?php
include ('includes/header.php');
include ('classes/Menus.php');

$Menu = new Menus();
$MenuList = $Menu->getMenuById($_REQUEST['id']);
?>

<div class="container">
    <form action="" method="POST" id="myForm" enctype="multipart/form-data">
        <div class="parent">
            <!-- Menu Name -->
            <div class="parent-flex">
                <label for="menu_name">Menu Name</label>
                <input type="text" id="menu_name" name="menu_name" value="<?php echo $menu_name; ?>" required>
            </div>
            <!-- Category Selection -->
            <div class="parent-flex">
                <div class="left-container">
                    <label for="category">Category</label><br />
                    <!-- Assuming $category is set correctly, use PHP to check and mark the selected category -->
                    <input type="radio" id="maindish" name="category" value="Main Dish" <?php echo ($category == 'Main Dish') ? 'checked' : ''; ?> required>
                    <input type="radio" id="soup" name="category" value="Soup" <?php echo ($category == 'Soup') ? 'checked' : ''; ?> required>
                    <input type="radio" id="salad" name="category" value="Salad" <?php echo ($category == 'Salad') ? 'checked' : ''; ?> required>
                    <input type="radio" id="appetizer" name="category" value="Appetizer" <?php echo ($category == 'Appetizer') ? 'checked' : ''; ?> required>
                    <input type="radio" id="dessert" name="category" value="Dessert" <?php echo ($category == 'Dessert') ? 'checked' : ''; ?> required>
                </div>
            </div>
            <div class="parent-flex">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="price" value="<?php echo $price; ?>" required>
            </div>
            <div class="parent-flex">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="description" value="<?php echo $description; ?>" required>
            </div>
            <!-- Product Description and Image -->
            <button name="btn" id="btn" class="submit_btn">SUBMIT</button>
        </div>
    </form>
</div>
<?php
include ('includes/footer.php');
?>
