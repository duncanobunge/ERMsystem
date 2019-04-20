<?php 
include("include/header.php"); 
if(isset($_SESSION['user'])){

  header("Location:http://localhost/IMS/index.php");

}
if(isset($_GET['active']) || isset($_POST['submit'])){

  $tk =isset($_POST['submit']) ? $_POST['active']:  $_GET['active'];
  $id =isset($_POST['submit']) ? $_POST['id']:  $_GET['id'];
  
  $user -> activate($id,$tk);
}

?>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Activation Code</h1>
                    <p class="mb-4">We have sent you an email with activation code.</p>
                  </div>
                  <?php 
                      if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';

                      }
                   ?>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text"  name="active" class="form-control form-control-user" id="InputActivationCode" 
                       placeholder="Enter Activation Code">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>" />
                    <button type="submit" name="submit" class="btn btn-primary btn-us er btn-block">
                      Activate
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
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

    </div>

  </div>

  <?php include("include/footer.php"); ?>
