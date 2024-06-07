<?php
include ('includes/header.php');
include ('classes/Menus.php');

$Menu = new Menus();
$MenuList = $Menu->displayMenu();
?>

<div class="container">
    <?php foreach ($MenuList as $menu){ ?>
        <div class="menu-item">
            <h3><?php echo $menu['menu_name']; ?></h3>
            <p>Description: <?php echo $menu['description']; ?></p>
            <p>Price: <?php echo $menu['price']; ?></p>
            <p>Category: <?php echo $menu['category']; ?></p>
            <?php if ($menu['image']) { ?>
              <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image" class="rounded-circle img-fluid" width="100">
            <?php } else { ?>
              No Image
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php include ('includes/footer.php'); ?>
