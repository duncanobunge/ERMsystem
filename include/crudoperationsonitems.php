<?php  
//session_start();
$item_supplier=
$description=$po_number=$quantity=$itemuom=$remarks=$delivery_date=$receiver_name=$creation_id="";
class Crudoperationsonitems extends mysqli{
function __construct()
 {
      Parent::__construct("localhost","root","","inventory_db");
  
      if($this->connect_error){
          $_SESSION['error']="DB Connection error: ". $this->connect_error;
         return;
      }else
      {

        if(isset($_GET['item_supplier']))
        {

            $item_supplier =$_GET['item_supplier'];
            $description =$_GET['description'];
            $po_number = $_GET['po_number'];
            $quantity = $_GET['quantity'];
            $delivery_date = $_GET['delivery_date'];
            $itemuom = $_GET['uom'];
            $creation_id = $_SESSION['user'];
            $remarks = $_GET['remarks'];

            $qu ="INSERT INTO `delivereditems_tbl` (`item_id`, `item_supplier`, `item_description`, `po_number`, `quantity`, `uom`, `delivery_date`, `receiver_name`, `remarks`, `creater_id`, `creation_date`) 
            VALUES (NULL, '$item_supplier', '$description', '$po_number', '$quantity', '$itemuom', '2019-04-21 00:00:00', 'Uncn', 'std quality', '2', CURRENT_TIMESTAMP)";
            $run =$this->query($qu); //execute the INSERT query
        
   //check if the query is successfully executed
                if($run)
                {
                    header("Location:http://localhost/IMS/newlydelivereditems.php");
                }
                else
                {
                    $_SESSION['error']="Error occurs when adding the item";
                }
                        /*   $this->addItem($item_supplier,$description, $po_number,$quantity,$itemuom,$delivery_date,$receiver_name,$remarks,$creation_id);*/
                $this->getItems();

        }elseif(isset($_GET['depart_name'])){
            $depart_name = $_GET['depart_name'];
            $depart_description = $_GET['description'];

            $insert_qry = "INSERT INTO departments (department_id,department_name,department_description,creator_id,date_of_creation)
                           VALUES (NULL,'$depart_name','$depart_description','0',CURRENT_TIMESTAMP)";
            $exe_qry = $this->query($insert_qry);
                
               if($exe_qry)
                  {
                    header("Location:http://localhost/IMS/department.php");
                  }
               else
                 {
                    $_SESSION['error']="Error occurs when adding the department";
                 }
        }
    }

}

public function addItem($item_supplier,
$description, $po_number,$quantity,$itemuom,$delivery_date,$receiver_name,$remarks,$creation_id)
{


   //INSERT ITEM Query 
   $q="INSERT INTO delivereditems_tbl(item_id,item_supplier,item_description,po_number,quantity,uom,delivery_date,receiver_name,remarks,creater_id,creation_date)
        VALUES('','$item_supplier','$description','$po_number','$quantity','$itemuom','$delivery_date','$receiver_name','$remarks','$creation_id',CURRENT_TIMESTAMP)";
   $run = $this->query($q); //execute the INSERT query
   var_dump($run);
   //check if the query is successfully executed
   if($run)
   {

    header("Location:http://localhost/IMS/newlydelivereditems.php");
   }
   else
   {
       $_SESSION['error']="Error occurs when adding the item";
   }
}
 public function getItems(){
    $q = "SELECT * FROM delivereditems_tbl";
    $run = $this->query($q);
    $row = $run->fetch_object();
    return $row;
 }
 

}




?>