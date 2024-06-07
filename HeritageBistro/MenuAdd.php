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
?>

<div class="container">
    <form action="" method="POST" id="myForm" enctype="multipart/form-data">
        <div class="parent">
            <!-- Menu Name -->
            <div class="parent-flex">
                <label for="menu_name">Menu Name</label>
                <input type="text" id="menu_name" name="menu_name" required>
            </div>
            <!-- Category Selection -->
            <div class="parent-flex">
                <div class="left-container">
                    <label for="category">Category</label><br />
                    <input type="radio" id="maindish" name="category" value="Main Dish" required>
                    <label for="maindish">Main Dish</label><br>
                    <input type="radio" id="soup" name="category" value="Soup" required>
                    <label for="souporsalad">Soup </label><br>
                    <input type="radio" id="salad" name="category" value="Salad" required>
                    <label for="souporsalad">Salad </label><br>
                    <input type="radio" id="appetizer" name="category" value="Appetizer" required>
                    <label for="appetizer">Appetizer</label><br>
                    <input type="radio" id="dessert" name="category" value="Dessert" required>
                    <label for="dessert">Dessert</label><br><br>
                </div>
            </div>
            <div class="parent-flex">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="price" required>
            </div>
            <div class="parent-flex">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="description" required>
            </div>
            <!-- Product Description and Image -->
            <div class="parent-flex">
                <div class="left-container">
                    <!-- Insert Image -->
                    <label for="menu_image">Insert Image:</label>
                    <input type="file" id="menu_image" name="menu_image" class="menu_image" required><br>
                    <button name="btn" id="btn" class="submit_btn">SUBMIT</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
include ('includes/footer.php');
?>
