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
<div class="front-desk-parent">



<div class="index-parent">


<div class="left-navigationS">
    <!-- <?php 
    include('./navigation/navigation.php');
    ?> -->
</div>
<div class="right-content">


<div class="order-container">

    

    <form action="" method="POST" id="myForm" class="form-container">

    <div class="display-order-container">
            <div class="left-order">

     
        <div id="menu_items" class="menu-items-container">
            <?php foreach ($MenuList as $menu) { ?>

              
                <div class="menu-item card"
                    onclick="selectMenu(<?php echo $menu['id']; ?>, '<?php echo $menu['menu_name']; ?>', <?php echo $menu['price']; ?>, '<?php echo $menu['image']; ?>')">
                    <div class="card-img">
                        <img src="./uploaded_image/<?php echo $menu['image']; ?>" alt="User Image"
                            class="rounded-circle img-fluid" width="100">
                    </div>
                    <div class="card-body">
                        <h class="card-title"><?php echo $menu['menu_name']; ?></h>
                        <p class="card-text">Price: ₱<?php echo number_format($menu['price'], 2); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    
    </div>

    <div class="right-order">
                      

                  <!-- <div class="menu-items-left-container">
                    <p>Order Summary</p>
                    <div class="menu-items-details" id="selectedMenuDetails">

                        

                        
                    </div>

                     <div class="payment-summary">
                    
                     <h2>Total Amount: ₱<span id="totalAmountDisplay">0.00</span></h2>
                    <input type="hidden" name="total_amount" id="total_amount" value="0">
                    <button type="submit" name="btn" class="PlaceOrder">Place Order</button>
                         </div>                    
           


                   

             </div> -->

             <div class="menu-items-left-container">

                <div class="order-summary">
                    <h1> Order Summary</h1>
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
                            <!-- butangi lang amount mate , ty -->
                            <p>100</p>
                        </div>
                    </div>
                     <h2>Total Amount: ₱<span id="totalAmountDisplay">0.00</span></h2>
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

                <div class = "card-invoice">
                <h1 class="card-title">${menuName}</h1>
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
        const price = parseFloat(card.querySelector('.card-text:nth-child(3)').textContent.replace('Price: ₱', ''));
        const quantity = parseInt(card.querySelector('input[name="quantity[]"]').value);
        const subtotal = price * quantity;
        card.querySelector('.subtotal').textContent = subtotal.toFixed(2);
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
                updateSubtotal(e.target.closest('.card'));
                updateTotalAmount();
            }
        });
    });
</script>

<?php
include ('includes/footer.php');
?>
