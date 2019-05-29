
<?php 
  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
  include('include/navbar.php');

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Departments</h1>
          <p class="mb-4">List of Department</p>
          <?php 
                      if(isset($_SESSION['error']))
                      {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';

                      }
          ?>
          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Departments Details</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     
                      <th>Department Name</th>
                      <th>Description</th>
                      <th>Created by</th>
                      <th>Date created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Department Name</th>
                      <th>Description</th>
                      <th>Created by</th>
                      <th>Date created</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                        $conn = mysqli_connect("localhost","root","","inventory_db");
                        $q ="SELECT * FROM departments";
                        $run = mysqli_query($conn, $q);
                        if($run)
                          {
                            while ($row = mysqli_fetch_array($run))
		                      {
                      ?>
                    <tr>
                      
                      <td><?php echo $row['department_name']; ?></td>
                      <td><?php echo $row['department_description']; ?></td>
                      <td><?php echo $row['creator_id']; ?></td>
                      <td><?php echo $row['date_of_creation']; ?></td>
                      <td>
                         <a href="edit_department.php?id=<?php echo $row['department_id']; ?>">
                         <button class="btn btn-primary">
                                Edit
                          </button>
                          </a> |
                         <a href="delete_department.php?id=<?php echo $row['department_id']; ?>"><button class="btn btn-danger">Trash</button></a>
                      </td>
                    </tr>
                        <?php 
                           } 
                          }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="additemsection">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addDepartModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-primary">Add</button>
            </a>
          </div>
          <!--<div class="container">
            <h1>Upload Excel Data</h1>
            <form method="POST" action="excelUpload.php" enctype="multipart/form-data">
            <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
            </div>
            <p>Download your data  : <a href="demo.ods">Demo.ods</a></p>--
            </form>
            </div>-->
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
