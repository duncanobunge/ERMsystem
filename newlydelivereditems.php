
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
          <h1 class="h3 mb-2 text-gray-800">Newly Delivered Items</h1>
          <p class="mb-4">This is a dashboard for items that have been delivered for the first time in the store</p>
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
              <h6 class="m-0 font-weight-bold text-primary">Delivery Particulars</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     
                      <th>Item Description</th>
                      <th>Delivery Date</th>
                      <th>Supplier</th>
                      <th>P.O. No.</th>
                      <th>Qty Received</th>
                      <th>UoM</th>
                      <th>Remarks</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Item Description</th>
                      <th>Delivery Date</th>
                      <th>Supplier</th>
                      <th>P.O. No.</th>
                      <th>Qty Received</th>
                      <th>UoM</th>
                      <th>Remarks</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                        $conn = mysqli_connect("localhost","root","","inventory_db");
                        $q ="SELECT * FROM delivereditems_tbl";
                        $run = mysqli_query($conn, $q);
                        if($run)
                          {
                            while ($row = mysqli_fetch_array($run))
		                      {
                      ?>
                    <tr>
                      
                      <td><?php echo $row['item_description']; ?></td>
                      <td><?php echo $row['delivery_date']; ?></td>
                      <td><?php echo $row['item_supplier']; ?></td>
                      <td><?php echo $row['po_number']; ?></td>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['uom']; ?></td>
                      <td><?php echo $row['receiver_name']; ?></td>
                      <td>
                         <a href="edit_item.php?id=<?php echo $row['item_id']; ?>">
                         <button class="btn btn-primary">
                                Edit
                          </button>
                          </a> |
                          <a href="add_issued_items.php?id=<?php echo $row['item_id']; ?>">
                          <button class="btn btn-warning">
                                Issue
                          </button>
                          </a> 
                          |
                         <a href="delete_item.php?id=<?php echo $row['item_id']; ?>"><button class="btn btn-danger">Trash</button></a>
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
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addItemModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-primary">Add</button>
            </a>
          </div>
          <div class="container">
            <h1>Upload Excel Data</h1>
            <form method="POST" action="excelUpload.php" enctype="multipart/form-data">
            <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
            </div>
            <!--<p>Download your data  : <a href="demo.ods">Demo.ods</a></p>-->
            </form>
            </div>
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
