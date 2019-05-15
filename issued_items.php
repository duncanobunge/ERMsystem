
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
          <h1 class="h3 mb-2 text-gray-800">Stock Issuance</h1>
          <p class="mb-4">This is a dashboard for stock Issuance</p>
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
              <h6 class="m-0 font-weight-bold text-primary">Stock Particulars</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Item Name</th>
                      <th>Description</th>
                      <th>P.O. No.</th>
                      <th>Quantity</th>
                      <th>Delivery Date</th>
                      <th>Receiver(Staff Name)</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>P.O. No.</th>
                    <th>Qnty-Issued</th>
                    <th>Issuance Date</th>
                    <th>Staff Name</th>
                    <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                        $conn = mysqli_connect("localhost","root","","inventory_db");
                        $q ="SELECT * FROM delivereditems_tbl dtbl INNER JOIN issued_items_tbl itbl
                             ON dtbl.item_id=itbl.item_id";
                        $run = mysqli_query($conn, $q);
                        if($run)
                          {
                            while ($row = mysqli_fetch_array($run))
		                      {
                      ?>
                    <tr>
                      <td><?php echo $row['item_name']; ?></td>
                      <td><?php echo $row['item_description']; ?></td>
                      <td><?php echo $row['po_number']; ?></td>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['date_of_issuance']; ?></td>
                      <td><?php echo $row['item_receiver']; ?></td>
                      <td>
                         <a href="edit_item.php?id=<?php echo $row['item_id']; ?>">
                         <button class="btn btn-primary">
                                Edit
                          </button>
                          </a> |
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
          <div id="issueitemsection">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#issueItemModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-primary" >Issue Item</button>
            </a>
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