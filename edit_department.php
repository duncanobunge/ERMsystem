<?php 
  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
include('include/navbar.php');
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_REQUEST['id'];
$query = "SELECT * FROM departments WHERE department_id='$id'"; 
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Update Department</h1>
          <p class="mb-4">Update your selected Department below here</p>
          <?php 
                      if(isset($_SESSION['error']))
                      {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';

                      }

                      //if(isset($_POST['new']) && $_POST['new']==1)
                      if(isset($_POST['new']) && $_POST['new']==1)
                        {
                        $id=$_REQUEST['id'];
                        $department_name=$_REQUEST['depart_name'];
                        $description=$_REQUEST['description'];
                      
                        //$submittedby = $_SESSION["user"];

                        $query = "UPDATE `departments` SET `department_name`='$department_name', 
                                 `department_description`='$description' WHERE `department_id`='$id'";
                                
                        $run_qry=mysqli_query($con,$query);
                        if( $run_qry){
                            header("Location:http://localhost/IMS/department.php");
                        }else{
                            die(mysqli_error($con));
                        }
                       
                      
                    }
        ?>
          <!-- Edit form Example -->
        <div class="dash">
        <form class="user" method="post" action="edit_department.php" role="form" id="addDepartForm" name="editDepartment">
        <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Department Name</span>
              </div>
                <input type="hidden" name="id" value="<?php echo $row['department_id'];?>" >
                <input type="text" class="form-control" name="depart_name" value="<?php echo $row['department_name']; ?>" id="depart_name" required="required" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Department Description</span>
              </div>
                <input type="text" class="form-control" name="description" value="<?php echo $row['department_description']; ?>" id="description" required="required" aria-describedby="basic-addon3">
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="submit">Update</button>
            </div>
        </div>
      </form>
    </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      

  <?php 
      include('include/content-footer.php');
  //}}
  ?>
</body>

</html>
