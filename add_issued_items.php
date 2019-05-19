<?php 
  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
include('include/navbar.php');
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_REQUEST['id'];
$query = "SELECT * from delivereditems_tbl where item_id='".$id."'"; 
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

 
?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Issuance of Items</h1>
          <p class="mb-4">Issue the selected Item below here</p>
          <?php 
                      if(isset($_SESSION['error']))
                      {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $_SESSION['error'];
                        echo '</div>';

                      }

                      if(isset($_POST['new']) && $_POST['new']==1)
                        {
                        $id=$_REQUEST['id'];
                        $qnty = $_REQUEST['initial_qty'];
                        $quantity =$_REQUEST['quantity'];
                        $issuance_date =$_REQUEST['issuance_date'];
                        $uoi =$_REQUEST['uoi'];
                        $facility =$_REQUEST['facility'];
                        $department =$_REQUEST['department'];
                        $voucher_no =$_REQUEST['voucher_no'];
                        $receiver_name =$_REQUEST['receiver_name'];
                        $submittedby = $_SESSION['user'];
                        $qty_rem = $qnty-$quantity;


                       $query="INSERT INTO `issued_items_tbl` (`item_issued_id`, `item_id`, `quantity`, `issuer_id`, `item_receiver`, `date_of_issuance`, `department`, `facility`, `uoi`, `voucher_no`, `date_created`)
                               VALUES(NULL,'$id','$quantity','2','$receiver_name','$issuance_date','$department','$facility','$uoi','$voucher_no',CURRENT_TIMESTAMP)";
                        $run=mysqli_query($con, $query) or die(mysqli_error($con));
                        if($run){
                            $qry ="UPDATE delivereditems_tbl SET quantity='$qty_rem' WHERE item_id='$id'";
                            mysqli_query($con, $qry) or die(mysqli_error($con));
                            echo("<script>location.href = 'issued_items.php';</script>");
                       }
                      
                    }
        ?>
          <!-- Edit form Example -->
          
        <div class="dash">
        <form class="user" method="post" action="", role="form" id="additemsForm" name="addItems">
        <div class="modal-body">
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Issuance Date</span>
              </div>
                <input type="date" class="form-control" name="issuance_date" id="issuance_date" 
                value="<?php echo CURRENT_TIMESTAMP;?>" aria-describedby="basic-addon3">
            </div>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Item Description</span>
              </div>
                <input type="text" class="form-control" name="description" id="description"  
                value="<?php echo $row['item_description'];?>" aria-describedby="basic-addon3">
          </div>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Receiver Officer</span>
              </div>
                <input type="text" class="form-control" name="receiver_name" id="receiver_name" 
                value="" aria-describedby="basic-addon3">
          </div>
          <div class="input-group mb-3">
              <input type="hidden" name="new" value="1" />
               <input name="id" type="hidden" value="<?php echo $row['item_id'];?>" />
               <input name="initial_qty" type="hidden" value="<?php echo $row['quantity'];?>" />
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Department</span>
              </div>
                <input type="text" class="form-control" name="department" id="department"  
                value="" aria-describedby="basic-addon3">
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Uoi</span>
              </div>
                <input type="text" class="form-control" name="uoi" id="uoi"
                value=""  aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Qnty Issued</span>
              </div>
                <input type="text" class="form-control" name="quantity" id="quantity" 
                value="" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Facility</span>
              </div>
                <input type="text" class="form-control" name="facility" id="facility"
                value=""  aria-describedby="basic-addon3">
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Voucher No</span>
              </div>
                <input type="text" class="form-control" name="voucher_no" id="voucher_no" 
                value="" aria-describedby="basic-addon3">
            </div>
            
            <div class="modal-footer">
              <button class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="submit">Issue Item</button>
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
