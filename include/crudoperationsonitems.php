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




  /*session_start();
  
  public function addItems(){


        /*if($data["item_name"]= ""){
           
            $_SESSION['error'] = "Item Name Cannot be empty.";
        }elseif($data["description"]= ""){

            $_SESSION['error'] = "Description Cannot be empty.";
        }elseif($data["po_number"]= ""){

            $_SESSION['error'] = "P.O. No. Cannot be empty.";
        }elseif($data["quantity"]= ""){

            $_SESSION['error'] = "Quantity Cannot be empty.";
        }elseif($data["delivery_date"]= ""){

            $_SESSION['error'] = "Delivery Date Cannot be empty.";
        }elseif($data["receiver_name"]= ""){

            $_SESSION['error'] = "Receiver Name Cannot be empty.";
        } else{

            $item_name = $data["item_name"];
            $description = $data["description"];
            $po_number = $data["po_number"];
            $quantity = $data["quantity"];
            $delivery_date = $data["delivery_date"];
            $receiver_name= $data["receiver_name"];
            $creation_id = $_SESSION['user_id'];

        }
        if(isset($_POST['item_name']))
        {
      
        }
        
    public function getItems()
        {
            $q = "SELECT * FROM delivereditems_tbl";
            $run = $this->query($q);
            $row = $run->fetch_object();
            return $row;
        }


}*/

?>