<?php 

  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_GET['id'];
echo $id;
$query = "DELETE FROM delivereditems_tbl WHERE item_id='$id'"; 
$run = mysqli_query($con, $query);

if($run){
  header("Location:http://localhost/IMS/newlydelivereditems.php");
}else{
  die (mysqli_error($con));
}


?>

