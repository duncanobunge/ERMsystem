<?php 
$con = mysqli_connect("localhost","root","","inventory_db");
if($con){
    echo "Successful connection to the DB";
}
else{
    echo"Connection to the DB not successful";
}