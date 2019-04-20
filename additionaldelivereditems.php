
<?php 
  session_start();
  include("include/content-header.php");
  /*if(!isset($_SESSION['user'])){

      header("Location:http://localhost/IMS/include/login.php");

  }else{
        if((time() - $_SESSION['last_time']) > 60){

          header("Location:http://localhost/IMS/include/logout.php");
        }else{
        */
            include("include/navbar.php");
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Additional Delivered Items</h1>
          <p class="mb-4">A dashboard for additional items already in stock</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Delivery Particulars</h6>
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
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>P.O. No.</th>
                    <th>Quantity</th>
                    <th>Delivery Date</th>
                    <th>Receiver(Staff Name)</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>$320,800</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      

  <?php 
      include("include/content-footer.php");
  //}}
  ?>
</body>

</html>
