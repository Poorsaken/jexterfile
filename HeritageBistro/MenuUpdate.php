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
?>

<div class="index-parent">

<div class="left-navigation">
    <?php 
    include('./navigation/navigation.php');
    ?>
</div>
<div class="right-content">

<form action="" method="POST" id="myForm" enctype="multipart/form-data">
        <div class="parent">
            <!-- Menu Name -->
            <div class="parent-flex">
                <label for="menu_name">Menu Name</label>
                <input type="text" id="menu_name" name="menu_name" value="<?php echo htmlspecialchars($menu_name); ?>"
                    required>
            </div>
            <!-- Category Selection -->
            <div class="parent-flex">
                <div class="left-container">
                    <label for="category">Category</label><br />
                    <input type="radio" id="maindish" name="category" value="Main Dish" <?php echo ($category == 'Main Dish') ? 'checked' : ''; ?> required>
                    <label for="maindish">Main Dish</label><br>
                    <input type="radio" id="soup" name="category" value="Soup" <?php echo ($category == 'Soup') ? 'checked' : ''; ?> required>
                    <label for="soup">Soup</label><br>
                    <input type="radio" id="salad" name="category" value="Salad" <?php echo ($category == 'Salad') ? 'checked' : ''; ?> required>
                    <label for="salad">Salad</label><br>
                    <input type="radio" id="appetizer" name="category" value="Appetizer" <?php echo ($category == 'Appetizer') ? 'checked' : ''; ?> required>
                    <label for="appetizer">Appetizer</label><br>
                    <input type="radio" id="dessert" name="category" value="Dessert" <?php echo ($category == 'Dessert') ? 'checked' : ''; ?> required>
                    <label for="dessert">Dessert</label><br><br>
                </div>
            </div>
            <div class="parent-flex">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="price" value="<?php echo htmlspecialchars($price); ?>"
                    required>
            </div>
            <div class="parent-flex">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="description"
                    value="<?php echo htmlspecialchars($description); ?>" required>
            </div>
            <!-- Submit Button -->
            <button name="btn" id="btn" class="submit_btn">SUBMIT</button>
        </div>
    </form>

</div>
</div>


    

<?php include ('includes/footer.php'); ?>