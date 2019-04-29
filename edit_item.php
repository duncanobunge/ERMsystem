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
                        //$trn_date = date("Y-m-d H:i:s");
                        $itemname =$_REQUEST['item_name'];
                        $description =$_REQUEST['description'];
                        $po_number =$_REQUEST['po_number'];
                        $quantity =$_REQUEST['quantity'];
                        $delivery_date =$_REQUEST['delivery_date'];
                        $receiver_name =$_REQUEST['receiver_name'];
                        //$submittedby = $_SESSION["user"];

                        $query = "UPDATE `delivereditems_tbl` SET `item_name` = '$itemname', `item_description` = '$description',
                         `po_number` = '$po_number', `quantity` = '$quantity', `delivery_date` = '$delivery_date',
                          `receiver_name` = '$receiver_name', `creater_id` = 1
                         WHERE `delivereditems_tbl`.`item_id` = '$id'";
                        mysqli_query($con, $query) or die(mysqli_error($con));
                        echo("<script>location.href = 'newlydelivereditems.php';</script>");
                      
                    }
        ?>
          <!-- Edit form Example -->
          
        <div class="dash">
        <form class="user" method="post" action="", role="form" id="additemsForm" name="addItems">
        <div class="modal-body">
          <div class="input-group mb-3">
              <input type="hidden" name="new" value="1" />
               <input name="id" type="hidden" value="<?php echo $row['item_id'];?>" />
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
                 <span class="input-group-text" id="basic-addon3">Delivery Date</span>
              </div>
                <input type="date" class="form-control" name="delivery_date" id="delivery_date" 
                value="<?php echo $row['delivery_date'];?>" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon3">Receiver Name</span>
              </div>
                <input type="text" class="form-control" name="receiver_name" id="receiver_name" 
                value="<?php echo $row['receiver_name'];?>" aria-describedby="basic-addon3">
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
