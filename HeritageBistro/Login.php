<?php 
include ('includes/header.php');
include('classes/Accounts.php'); 
$Account = new Accounts();
if (isset ($_REQUEST['btn']))
{
$Account -> checkUser($_REQUEST);
}
?>
<div class="container">
    <div class="content w-25">
    <h2 class="mb-4">Login </h2>
    <form method="POST">
    <div class="form-outline">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username"/>
        <label class="form-label" for="username">Username</label>
      </div>
      <div class="form-outline">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
        <label class="form-label" for="password">Password</label>
      </div>
      <input type="submit" value="Login" name = "btn" id = "btn" class="btn mb-2">
    </form>
    <div class="create-account">
      Don't have an account? <a href="userSignup.php">Create Account</a>
    </div>
    </div>
  </div>
<?php 
include ('includes/footer.php');
?>