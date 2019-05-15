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
                        //$trn_date = date("Y-m-d H:i:s");
                        //$itemname =$_REQUEST['item_name'];
                        //$description =$_REQUEST['description'];
                        //$po_number =$_REQUEST['po_number'];
                        $qnty = $_REQUEST['initial_qty'];
                        $quantity =$_REQUEST['quantity'];
                        $issuance_date =$_REQUEST['issuance_date'];
                        $receiver_name =$_REQUEST['receiver_name'];
                        $submittedby = $_SESSION['user_id'];
                        $qty_rem = $qnty-$quantity;


                       /*INSERT INTO issued_items_tbl INTO item_issued_item,item_id,quantity,issuer_id,item_receiver,date_of_issuance 
                                   VALUES('',)"*/
                        $query ="INSERT INTO `issued_items_tbl` (`item_issued_id`, `item_id`, `quantity`, `issuer_id`, `item_receiver`, `date_of_issuance`, `date_created`) 
                                   VALUES (NULL, '$id','$quantity','$submittedby','$receiver_name','$issuance_date', CURRENT_TIMESTAMP)";
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
              <input type="hidden" name="new" value="1" />
               <input name="id" type="hidden" value="<?php echo $row['item_id'];?>" />
               <input name="initial_qty" type="hidden" value="<?php echo $row['quantity'];?>" />
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Item Name</span>
              </div>
                <input type="text" class="form-control" name="item_name" id="item_name"  
                value="<?php echo $row['item_name'];?>" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Description</span>
              </div>
                <input type="text" class="form-control" name="description" id="description"  
                value="<?php echo $row['item_description'];?>" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">P.O. No.</span>
              </div>
                <input type="text" class="form-control" name="po_number" id="po_number"
                value="<?php echo $row['po_number'];?>"  aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Quantity</span>
              </div>
                <input type="text" class="form-control" name="quantity" id="quantity" 
                value="<?php echo $row['quantity'];?>" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Issuance Date</span>
              </div>
                <input type="date" class="form-control" name="issuance_date" id="issuance_date" 
                value="" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Receiver Name</span>
              </div>
                <input type="text" class="form-control" name="receiver_name" id="receiver_name" 
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
