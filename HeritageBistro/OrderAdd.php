<?php
include ('includes/header.php');
include ('classes/Orders.php');
include ('classes/Menus.php');
$Order = new Orders();
$Menus = new Menus();
$MenuList = $Menus->displayMenu();

if (isset($_POST['btn'])) {
    $data = [
        'total_amount' => $_POST['total_amount']
    ];

    $orderDetails = [];

    // Loop through menu items
    foreach ($_POST['menu_name'] as $key => $menuName) {
        $orderDetails[] = [
            'menu_id' => $_POST['menu_id'][$key],
            'menu_name' => $menuName,
            'price' => $_POST['price'][$key],
            'quantity' => $_POST['quantity'][$key]
        ];
    }

    $Order->addOrder($data, $orderDetails);
}
?>

<div class="order-container">
    <form action="" method="POST" id="myForm">
        <div class="menu-items-details">
            <table id="selectedMenuDetails">
                <thead>
                    <tr>
                        <th></th>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Image</th>
                        <td>Menu Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="menu_items" class="menu-items-container">
            <!-- Display menus as cards -->
            <?php foreach ($MenuList as $menu) { ?>
                <div class="menu-item card"
                    onclick="selectMenu(<?php echo $menu['id']; ?>, '<?php echo $menu['menu_name']; ?>', <?php echo $menu['price']; ?>)">
                    <div class="card-body">
                        <div class="card-img">
                            <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image"
                                class="rounded-circle img-fluid" width="100">
                        </div>

                        <h5 class="card-title"><?php echo $menu['menu_name']; ?></h5>
                        <p class="card-text">Price: $<?php echo number_format($menu['price'], 2); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="total_amount" id="total_amount" value="0">
        <!-- Menu items -->



        <!-- <button type="button" id="add_item">Add Item</button> -->
        <button type="submit" name="btn">Place Order</button>
    </form>
</div>
<script>
    function selectMenu(menuId, menuName, price) {
    const menuDetails = document.getElementById('selectedMenuDetails');
    const existingRow = document.querySelector(`tr[data-menu-id="${menuId}"]`);

    if (existingRow) {
        const quantityField = existingRow.querySelector('input[name="quantity[]"]');
        quantityField.value = parseInt(quantityField.value) + 1; // Increase quantity by 1
        updateSubtotal(existingRow); // Update subtotal for the existing row
    } else {
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-menu-id', menuId); // Set data attribute for menu ID
        newRow.innerHTML = `
            <td><img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="Menu Image" class="card-img" style="width: 75px; height: 75px;"></td>
            <td>${menuName}</td>
            <td>$${price.toFixed(2)}</td>
            <td><input type="number" name="quantity[]" value="1" min="1" required></td>
            <td>$<span class="subtotal">${price.toFixed(2)}</span></td>
            <input type="hidden" name="menu_id[]" value="${menuId}">
            <input type="hidden" name="menu_name[]" value="${menuName}">
            <input type="hidden" name="price[]" value="${price.toFixed(2)}">
        `;
        menuDetails.appendChild(newRow);
    }

    updateTotalAmount(); // Update total amount
}


    document.addEventListener('DOMContentLoaded', () => {
        const menuItems = document.getElementById('menu_items');
        let itemId = <?php echo count($MenuList) + 1; ?>;

        // Update total amount when quantity changes
        menuItems.addEventListener('change', (e) => {
            if (e.target.name === 'quantity[]') {
                updateTotalAmount();
            }
        });

        // Calculate total amount
        function updateTotalAmount() {
            const quantities = document.querySelectorAll('input[name="quantity[]"]');
            let total = 0;
            quantities.forEach((input) => {
                const price = input.parentElement.querySelector('input[name="price[]"]').value;
                const quantity = input.value;
                total += price * quantity;
            });
            document.getElementById('total_amount').value = total.toFixed(2);
        }
    });
</script>

<?php
include ('includes/footer.php');
?>