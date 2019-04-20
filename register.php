<?php include("include/header.php");
  if(isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
    if(isset($_POST['submit']) ){
      $user -> register($_POST);
    }
?>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block "></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <?php 
                      if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';

                      }
                   ?>
              <form class="user" method="post" >
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="firstname" class="form-control form-control-user" id="InputFirstName" 
                    value="<?php echo @$_POST['firstname'];?>" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="lastname" class="form-control form-control-user" id="InputLastName" 
                    value="<?php echo @$_POST['lastname'];?>" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="InputEmail"
                  value="<?php echo @$_POST['email'];?>" placeholder="Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="InputPassword"
                    value="<?php echo @$_POST['password']; ?>" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="repeat_password" class="form-control form-control-user" id="RepeatPassword"
                    value="<?php echo @$_POST['repeat_password'];?>" placeholder="Confirm Password">
                  </div>
                  
                </div>
                
                <div class="form-group">
                    <input type="date" name="dob" class="form-control form-control-user" id="InputDob" 
                    value="<?php echo @$_POST['dob'];?>" placeholder="Date of Birth">
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" id="PostalAddress" placeholder="Postal Address">
                    <?php 
                     echo @$_POST['address'];
                    ?>
                    </textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                  Register
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include("include/footer.php"); ?>
