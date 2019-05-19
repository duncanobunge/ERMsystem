<?php 
  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
include('include/navbar.php');
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_REQUEST['id'];
$query = "SELECT * from delivereditems_tbl as dtbl INNER JOIN issued_items_tbl as itbl ON 
          dtbl.item_id = itbl.item_id WHERE `itbl`.`item_issued_id`='$id'"; 
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

 
?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Update Items</h1>
          <p class="mb-4">Update your selected Item below here</p>
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
                        $quantity =$_REQUEST['quantity'];
                        $issuance_date =$_REQUEST['delivery_date'];
                        $receiver_name =$_REQUEST['receiver_name'];
                        $qty =$_REQUEST['qty'];
                         
                     

                        $query = "UPDATE `issued_items_tbl` SET `quantity` = '$quantity', `item_receiver` = '$receiver_name',
                                  date_of_issuance='$issuance_date' WHERE item_issued_id = '$id'";
                        $run = mysqli_query($con, $query) or die(mysqli_error($con));
                       
                        echo("<script>location.href = 'issued_items.php';</script>");
                      
                    }
        ?>
          <!-- Edit form Example -->
          
        <div class="dash">
        <form class="user" method="post" action="", role="form" id="additemsForm" name="addItems">
        <div class="modal-body">
        <div class="modal-body">
          <div class="input-group mb-3">
              <div class="input-group-prepend">
              <input name="id" type="hidden" value="<?php echo $row['item_id'];?>" />
               <input name="qty" type="hidden" value="<?php echo $row['dtbl.quantity'];?>" />
                 <span class="input-group-text" id="basic-addon3">Issuance Date</span>
              </div>
                <input type="date" class="form-control" name="issuance_date" id="issuance_date" 
                value="<?php echo $row['date_of_issuance'];?>" aria-describedby="basic-addon3">
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
                value="<?php echo $row['item_receiver'];?>" aria-describedby="basic-addon3">
          </div>
          <div class="input-group mb-3">
              <input type="hidden" name="new" value="1" />
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Department</span>
              </div>
                <input type="text" class="form-control" name="department" id="department"  
                value="<?php echo $row['department'];?>" aria-describedby="basic-addon3">
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Uoi</span>
              </div>
                <input type="text" class="form-control" name="uoi" id="uoi"
                value="<?php echo $row['uoi'];?>"  aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Qnty Issued</span>
              </div>
                <input type="text" class="form-control" name="quantity" id="quantity" 
                value="<?php echo $row['quantity'];?>" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Facility</span>
              </div>
                <input type="text" class="form-control" name="facility" id="facility"
                value="<?php echo $row['facility'];?>"  aria-describedby="basic-addon3">
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Voucher No</span>
              </div>
                <input type="text" class="form-control" name="voucher_no" id="voucher_no" 
                value="<?php echo $row['voucher_no'];?>" aria-describedby="basic-addon3">
            </div>
      
            <div class="modal-footer">
              <button class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="submit">Add Item</button>
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
