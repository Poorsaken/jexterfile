<?php


session_start();
include('./routes/router.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel = "stylesheet" href = "./css/signupforms.css"/>
</head>
<body>
   

   


    <div class="parent_container">

    <div class="left-container">
         <form action ="./loginfunction.php" method="post">
     <div class="heading">
                        <div class="create">
                <h1>Login Your Account.</h1>

                        </div>
                <div class="create " >
                  <a href="./signup.php" class="btn_tologin">Sign Up</a>
                </div>


            </div>
            <div class="wrapper">
  
            <div class="div">
                
            
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"> <?php echo $_GET['error']; ?></p>
                <?php }?>

                <label>Username</label><br/>
                <input type = "text" name="username" placeholder="username"><br/>
                
                <label>Password</label><br/>
                <input type = "password" name="password" placeholder="password"><br/>

                  

                <button type="submit" class="login-btn">Login</button><br/>
                  
        

            </div>
                   

            </div>    
 
    </form>
    </div>
    <div class="right-container">
        right
    </div>

    
       



    </div>
 
 
</body>
</html>