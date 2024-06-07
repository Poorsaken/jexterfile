<?php 
include('includes/header.php'); 
include('classes/Accounts.php'); 
$Account = new Accounts();

if(isset($_POST['btn'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
  
    $Account->addUsers($_REQUEST);
}
?>
<div class="container">
    <div class="content w-25">
    <h2 class="mb-4">Create Account</h2>
    <form method="POST" enctype="multipart/form-data">
    <div class="row mb-1">
    <div class="col">
      <div class="form-outline">
        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"/>
        <label class="form-label" for="last_name">Last Name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"/>
        <label class="form-label" for="first_name">First Name</label>
      </div>
    </div>
    <div class="form-outline">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username"/>
        <label class="form-label" for="username">Username</label>
      </div>
      <div class="form-outline">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
        <label class="form-label" for="password">Password</label>
      </div>
      <div class="form-outline">
            <select name="role" id="role">
              <option value=0>Administrator</option>
              <option value=1>Staff</option>
            </select>
            <label class="form-label" for="role">Account Type</label>
          </div>
      <input type="submit" value="Register" name = "btn" id = "btn" class="btn ms-2 mb-2 w-25">
    </form>
    <div class="create-account">
      Already have an Account? <a href="index.php">Login Here</a>
    </div>
    </div>
  </div>
<?php 
include ('includes/footer.php');
?>
