<?php


session_start();
include('./routes/router.php');
include ('./classes/Profile.php');
include('./Classes/Database.php');
global $DB;
global $con;

      $Signup = new Profile();
      $DB = new Database();
      $DB->connectDB();
      if (isset($_REQUEST['btn'])) {
        $Signup->StaffCreateAccount($_REQUEST);
        exit();
      

      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./css/signupforms.css"/>
</head>
<body>


    <div class="parent_container">

    <div class="left-container">
         <form action ="" method="POST">

            <div class="heading">
                        <div class="create">
                <h1>Create your Account.</h1>

                        </div>
                <div class="create " >
                  <a href="./loginform.php" class="btn_tologin">Login</a>
                </div>


            </div>
                    <div class="wrapper">
        
                    <div class="div">
                    
                    
                            <?php if (isset($_GET['error'])) { ?>
                            <p class="error"> <?php echo $_GET['error']; ?></p>
                        <?php }?>

                        
                        <label>first name</label><br/>
                        <input type = "text" name="fname" placeholder="fname"><br/>

                        <label>last name</label><br/>
                        <input type = "text" name="lname" placeholder="lname"><br/>

                        <label>Address</label><br/>
                        <input type = "text" name="address" placeholder="address"><br/>




                        <label>Username</label><br/>
                        <input type = "text" name="username" placeholder="username"><br/>
                        
                        <label>Password</label><br/>
                        <input type = "password" name="password" placeholder="password"><br/>

                        

                        <button class="login-btn" name="btn" id="btn">SUBMIT</button><br/>
                        
                      
                

                    </div>
                        

                    </div>    
        
            </form>
    </div>
    <div class="right-container">
        right
    </div>

    
       



    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('myForm').addEventListener('submit', function() {
        // Reset form fields after submission
        document.getElementById('myForm').reset();
    });
});
</script>
 
</body>
</html>