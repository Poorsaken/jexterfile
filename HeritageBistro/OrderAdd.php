
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <!-- Include your CSS stylesheets and other necessary scripts here -->
</head>
<body>
<div class="front-desk-parent">
    <div class="index-parent">
        <div class="left-navigationS">
            <!-- Include your navigation menu here if necessary -->
        </div>


        <div class="right-content">
            
            <div class="order-container">
                <form action="" method="POST" id="myForm" class="form-container">
                    <div class="display-order-container">
                        
                        <div class="left-order">

                       

                        <div class="category-clickable">
                            <div class="select-category">

                                <p>Select A Category</p>
                            </div>

                            <div class="cat-menu">

                                <div class="category-image">
                                    <img src="./img/serving-dish.png"/>
                                </div>
                                <div class="">
                                <h>Main Dish</h>

                                 <?php
                                        // Display count of main dishes using the countByCategory() method
                                        $mainDishCount = $Menus->countByCategory('Main Dish');
                                        echo "<p class='numberofitems'>$mainDishCount items</p>";
                                        ?>

                         
      
                                </div>
                            </div>
                            <div class="cat-menu">

                                <div class="category-image">
                                    <img src="./img/soup.png"/>
                                </div>
                                <div class="">
                                <h>Soup</h>
                                 <?php
                                   $SoupCount = $Menus->countByCategory('Soup');
                                        echo "<p class='numberofitems'>$SoupCount items</p>";
                                        ?>
                                  
                                </div>
                            </div>
                            <div class="cat-menu">

                                <div class="category-image">
                                    <img src="./img/salad.png"/>
                                </div>
                                <div class="">
                                <h>Salad</h>
                                 <?php
                                   $SaladCount = $Menus->countByCategory('Salad');
                                        echo "<p class='numberofitems'>$SaladCount items</p>";
                                        ?>
                                </div>
                            </div>

                            <div class="cat-menu">

                                <div class="category-image">
                                    <img src="./img/burger.png"/>
                                </div>
                                <div class="">
                                <h>Appetizer</h>
                                 <?php
                                   $AppetizerCount = $Menus->countByCategory('Soup');
                                        echo "<p class='numberofitems'>$AppetizerCount items</p>";
                                        ?>
                                </div>
                            </div>
                            <div class="cat-menu">

                                <div class="category-image">
                                    <img src="./img/cupcake.png"/>
                                </div>
                                <div class="">
                                <h>Dessert</h>
                                 <?php
                                   $DessertCount = $Menus->countByCategory('Soup');
                                        echo "<p class='numberofitems'>$DessertCount items</p>";
                                        ?>
                                </div>
                            </div>
                            
                            
                        </div>
                           
                            <div id="menu_items" class="menu-items-container">
                                  <div class="your-menu">

                                <p>All Menu</p>
                            </div>
                                <?php foreach ($MenuList as $menu) { ?>
                                    <div class="menu-item card"
                                         onclick="selectMenu(<?php echo $menu['id']; ?>, '<?php echo $menu['menu_name']; ?>', <?php echo $menu['price']; ?>, '<?php echo $menu['image']; ?>')">
                                        <div class="card-img">
                                            <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image"
                                                 class="rounded-circle img-fluid" width="100">
                                        </div>
                                        <div class="card-body">
                                            <h class="card-title"><?php echo $menu['menu_name']; ?></h>
                                            <p class="card-text">₱<?php echo number_format($menu['price'], 2); ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="right-order">
                            <div class="menu-items-left-container">
                                <div class="order-summary-header">
                                    
                                <div class="order-summary">
                                    <h1> Order Summary</h1>
                                </div>
                                <a href="OrderDisplay.php">


                                    <div class="order-summary">
                                        <h>View Orders</h>
                                    </div>
                                </a>
                                </div>
                                
                                <div class="menu-items-details" id="selectedMenuDetails">
                                </div>
                                <div class="payment-summary">
                                    <h1>Payment Summary</h1>
                                    <div class="subtotal-payment">
                                        <div class="sub-text">
                                            <p>Subtotal:</p>
                                        </div>
                                        <div class="amount">
                                            <p>₱<span id="totalAmountDisplay">0.00</span></p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="total_amount" id="total_amount" value="0">
                                    <button type="submit" name="btn" class="PlaceOrder">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function selectMenu(menuId, menuName, price, image) {
        const menuDetails = document.getElementById('selectedMenuDetails');
        const existingCard = document.querySelector(`div[data-menu-id="${menuId}"]`);

        if (existingCard) {
            const quantitySpan = existingCard.querySelector('.quantity');
            const quantityInput = existingCard.querySelector('input[name="quantity[]"]');
            quantityInput.value = parseInt(quantityInput.value) + 1; // Increase quantity by 1
            quantitySpan.textContent = quantityInput.value; // Update displayed quantity
            updateSubtotal(existingCard); // Update subtotal for the existing card
        } else {
            const newCard = document.createElement('div');
            newCard.setAttribute('data-menu-id', menuId); // Set data attribute for menu ID
            newCard.classList.add('card');
            newCard.innerHTML = `
                <div class="card-body-invoice">
                    <div class="card-img-invoice">
                        <img src="./uploaded_image/${image}" alt="Menu Image" class="rounded-circle img-fluid" width="100">
                    </div>
                    <div class="card-invoice">
                        <div class="shanghai">
                        <div class = "card-title">
                        
                        <h1 class="card-title">${menuName}</h1>
                        </div>

                         <div class="card-remove">
        <img src="./img/close.png" alt="Remove" class="remove-img" onclick="removeMenu(${menuId})">
    </div>
                        
                        </div>
                        <p class="card-text">x<span class="quantity">1</span><input type="hidden" name="quantity[]" value="1"></p>
                        <p class="card-text">₱${price.toFixed(2)}</p>
                        <p class="card-text-subtotal">₱<span class="subtotal">${price.toFixed(2)}</span></p>
                        
                    </div>
                    <input type="hidden" name="menu_id[]" value="${menuId}">
                    <input type="hidden" name="menu_name[]" value="${menuName}">
                    <input type="hidden" name="price[]" value="${price.toFixed(2)}">
                </div>
            `;
            menuDetails.appendChild(newCard);
        }

        updateTotalAmount(); // Update total amount
    }

    function updateSubtotal(card) {
        const price = parseFloat(card.querySelector('.card-text:nth-child(3)').textContent.replace('₱', ''));
        const quantity = parseInt(card.querySelector('input[name="quantity[]"]').value);
        const subtotal = price * quantity;
        card.querySelector('.subtotal').textContent = subtotal.toFixed(2);
    }

    function updateTotalAmount() {
        const quantities = document.querySelectorAll('input[name="quantity[]"]');
        let total = 0;
        quantities.forEach((input) => {
            const price = parseFloat(input.closest('.card-body-invoice').querySelector('input[name="price[]"]').value);
            const quantity = parseInt(input.value);
            total += price * quantity;
        });
        document.getElementById('total_amount').value = total.toFixed(2);
        document.getElementById('totalAmountDisplay').textContent = total.toFixed(2);
    }

    function removeMenu(menuId) {
        const card = document.querySelector(`div[data-menu-id="${menuId}"]`);
        if (card) {
            card.remove();
            updateTotalAmount();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('selectedMenuDetails').addEventListener('change', (e) => {
            if (e.target.name === 'quantity[]') {
                updateSubtotal(e.target.closest('.card'));
                updateTotalAmount();
            }
        });
    });
</script>

<?php
include ('includes/footer.php');
?>
</body>
</html>
