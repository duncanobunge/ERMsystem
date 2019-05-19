<?php 

  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_GET['id'];
$query = "DELETE FROM `issued_items_tbl` WHERE `issued_items_tbl`.`item_issued_id`='$id'"; 
$run = mysqli_query($con, $query);

if($run){
  header("Location:http://localhost/IMS/issued_items.php");
}else{
  die (mysqli_error($con));
}


?>

