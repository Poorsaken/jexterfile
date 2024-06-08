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
    <form action="" method="POST" id="myForm" class="form-container">
        <div class="menu-items-details">
            <table id="selectedMenuDetails">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Diri ma ginuwa ang mga orders mo  -->
                </tbody>
            </table>
            <h2>Total Amount: ₱<span id="totalAmountDisplay">0.00</span></h2>
            <input type="hidden" name="total_amount" id="total_amount" value="0">
            <button type="submit" name="btn">Place Order</button>
        </div>
        <div id="menu_items" class="menu-items-container">
            <?php foreach ($MenuList as $menu) { ?>
                <div class="menu-item card"
                    onclick="selectMenu(<?php echo $menu['id']; ?>, '<?php echo $menu['menu_name']; ?>', <?php echo $menu['price']; ?>, '<?php echo $menu['image']; ?>')">
                    <div class="card-body">
                        <div class="card-img">
                            <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image"
                                class="rounded-circle img-fluid" width="100">
                        </div>
                        <h5 class="card-title"><?php echo $menu['menu_name']; ?></h5>
                        <p class="card-text">Price: ₱<?php echo number_format($menu['price'], 2); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </form>
</div>
<script>
    function selectMenu(menuId, menuName, price, image) {
        const menuDetails = document.getElementById('selectedMenuDetails');
        const existingRow = document.querySelector(`tr[data-menu-id="${menuId}"]`);

        if (existingRow) {
            const quantitySpan = existingRow.querySelector('.quantity');
            const quantityInput = existingRow.querySelector('input[name="quantity[]"]');
            quantityInput.value = parseInt(quantityInput.value) + 1; // Increase quantity by 1
            quantitySpan.textContent = quantityInput.value; // Update displayed quantity
            updateSubtotal(existingRow); // Update subtotal for the existing row
        } else {
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-menu-id', menuId); // Set data attribute for menu ID
            newRow.innerHTML = `
            <td><img src="./uploaded_image/${image}" alt="Menu Image" class="rounded-circle img-fluid" width="100"></td>
            <td>${menuName}</td>
            <td>₱${price.toFixed(2)}</td>
            <td><span class="quantity">1</span><input type="hidden" name="quantity[]" value="1"></td>
            <td>₱<span class="subtotal">${price.toFixed(2)}</span></td>
            <input type="hidden" name="menu_id[]" value="${menuId}">
            <input type="hidden" name="menu_name[]" value="${menuName}">
            <input type="hidden" name="price[]" value="${price.toFixed(2)}">
        `;
            menuDetails.appendChild(newRow);
        }

        updateTotalAmount(); // Update total amount
    }

    function updateSubtotal(row) {
        const price = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('₱', ''));
        const quantity = parseInt(row.querySelector('input[name="quantity[]"]').value);
        const subtotal = price * quantity;
        row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
    }

    function updateTotalAmount() {
        const quantities = document.querySelectorAll('input[name="quantity[]"]');
        let total = 0;
        quantities.forEach((input) => {
            const price = input.parentElement.parentElement.querySelector('input[name="price[]"]').value;
            const quantity = input.value;
            total += price * quantity;
        });
        document.getElementById('total_amount').value = total.toFixed(2);
        document.getElementById('totalAmountDisplay').textContent = total.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('selectedMenuDetails').addEventListener('change', (e) => {
            if (e.target.name === 'quantity[]') {
                updateSubtotal(e.target.closest('tr'));
                updateTotalAmount();
            }
        });
    });
</script>

<?php
include ('includes/footer.php');
?>