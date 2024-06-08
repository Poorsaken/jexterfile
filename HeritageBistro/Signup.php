
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
<div class="login-container">

    <div class="form-wrapper-signup">

<div class="content-signup w-25">

    <div class="form-login">
      <div class="logo">
        <img src='./img/HB 1.png' id="logo" alt=''> 
      </div>
<h class="mb-4">Create Your Account! </h>
<form method="POST" enctype="multipart/form-data">
    <div class="row mb-1">

    <div class="last-first">

          <div class="form-outline">
            <label class="form-label" for="first_name">First Name</label><br/>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"/>
          
     
      </div>

          
              <div class="form-outline">
                <label class="form-label" for="last_name">Last name</label><br/>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Lastname"/>
              </div>
        

    </div>

     

      <div class="last-first">
        <div class="form-outline">
          <label class="form-label" for="username">Username</label><br/>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username"/>
          </div>
          <div class="form-outline">
            <label class="form-label" for="password">Password</label><br/>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
          </div>

          </div>
          <div class="form-outline">
            <label class="form-label" for="role">Account Type</label><br/>
                <select name="role" id="role">
                  <option value=0>Administrator</option>
                  <option value=1>Staff</option>
                </select>
              </div>
          <input type="submit" value="Register" name = "btn" id = "btn" class="btn ms-2 mb-2 w-25">
            </form>
            <div class="create-account">
              Already have an Account? <a href="login.php">Login your account</a>
            </div>

      </div>
    


    
    </div>
  </div>
    </div>
    
<?php 
include ('includes/footer.php');
?>