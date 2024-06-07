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
?>

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Menu Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($MenuList as $menu){ ?>
            <tr>
                <td><?php echo $menu['menu_name']; ?></td>
                <td><?php echo $menu['description']; ?></td>
                <td><?php echo $menu['price']; ?></td>
                <td><?php echo $menu['category']; ?></td>
                <td>
                    <?php if ($menu['image']) { ?>
                        <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image" class="rounded-circle img-fluid" width="100">
                    <?php } else { ?>
                        No Image
                    <?php } ?>
                </td>
                <td>
                <form action="MenuUpdate.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                        </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include ('includes/footer.php'); ?>
