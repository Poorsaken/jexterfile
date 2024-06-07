<?php 
include ('includes/header.php');
include('classes/Accounts.php'); 
$Account = new Accounts();
if (isset ($_REQUEST['btn']))
{
$Account -> checkUser($_REQUEST);
}
?>
<div class="login-container">

    <div class="form-wrapper">

<div class="content w-25">

    <div class="form-login">
      <div class="logo">
        <img src='./img/HB 1.png' id="logo" alt=''> 
      </div>
<h class="mb-4">Welcome! </h>
<form method="POST">
    <div class="form-outline">
      <label class="form-label" for="username">Username</label><br/>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username"/>
      </div>
      <div class="form-outline">
        <label class="form-label" for="password">Password</label><br/>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
      </div>
      <input type="submit" value="Login" name = "btn" id = "btn" class="btn mb-2">
    </form>
    <div class="create-account">
      Don't have an Account? <a href="Signup.php">Create Account</a>
    </div>

    </div>
    


    
    </div>
  </div>
    </div>
    
<?php 
include ('includes/footer.php');
?>