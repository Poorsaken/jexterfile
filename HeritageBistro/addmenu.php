
<?php
session_start();
// include('./routes/router.php');


        
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
?>


    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>EVENTR!</title>
            <!-- <link rel="stylesheet" href="./css/landingpage.css"/> -->

            <!-- <link rel= "stylesheet" href = "./css/admindashboard.css"/> -->
            <link rel = "stylesheet" href = "./css/addmenu.css"/>
        </head>
        <body>
            

        <div class="parent_container">
            <div class="left-container">
                <?php 
                    include('./navigation/navigation.php');
                ?>
            </div>
            <div class="right-container">
               


                <div class="card-container">

                <div class="events_header_container">
                    <div class="events-title">
                        
                        <h1>Add Menu</h1>
                    </div>
                </div>
                
                <?php 

                    include('./classes/database.php');
                    include('./classes/Profile.php');
                    
                $DB = new Database(); //instantiation
                $DB->connectDB();
                $profile = new Profile();

                if (isset($_REQUEST['btn'])) {
                    $profile->insertProduct($_REQUEST, $_FILES);
                }
                ?>
                <form action="" method="POST" id="myForm" enctype="multipart/form-data">
                    <div class="parent">
                        <!-- Menu Name -->
                        <div class="parent-flex">
                            <div class="left-container">
                                <label for="menuname">Menu Name</label><br/>
                                <input type="text" id="menuname" name="menuname" required><br><br>
                            </div>
                        </div>
                        <!-- Category Selection -->
                        <div class="parent-flex">
                            <div class="left-container">
                                <label for="category">Category</label><br/>
                                <input type="radio" id="maindish" name="category" value="maindish" required>
                                <label for="maindish">Main Dish</label><br>
                                <input type="radio" id="souporsalad" name="category" value="souporsalad" required>
                                <label for="souporsalad">Soup or Salad</label><br>
                                <input type="radio" id="appetizer" name="category" value="appetizer" required>
                                <label for="appetizer">Appetizer</label><br>
                                <input type="radio" id="dessert" name="category" value="dessert" required>
                                <label for="dessert">Dessert</label><br><br>
                            </div>
                        </div>
                        <!-- Product Description and Image -->
                        <div class="parent-flex">
                            <div class="left-container">
                                <label for="product_desc">Price:</label>
                                <input type="text" id="price" name="price" class="price" required><br><br>
                                <!-- Insert Image -->
                                <label for="product_image">Insert Image:</label>
                                <input type="file" id="menu_image" name="menu_image" class="menu_image" required><br>
                                <button name="btn" id="btn" class="submit_btn">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </form>
                            
                </div>
            </div>
        </div>

        </body>
    </html>

    <?php

}
else {

    header("Location: logins.php");
    exit();
}

?>





