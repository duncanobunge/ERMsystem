
<?php 
  include('include/content-header.php');
  if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}
$con = mysqli_connect("localhost","root","","inventory_db");
$id=$_REQUEST['id'];
$query = "DELETE FROM delivereditems_tbl where item_id='".$id."'; 
mysqli_query($con,$query) or die (mysqli_error($con));
echo("<script>location.href = 'newlydelivereditems.php';</script>");
?>