<?php  
  //session_start();
  class Crudoperationsonitems extends User{

  public function createNewItem ($data){


        if($data["item_name"]= ""){
           
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

        }

        #create the table inventory_db.newlydelivereditems_tbl DDS
        $q ="CREATE TABLE `newlydelivereditems_tbl` (
             `newitem_id` int(10) auto_increment NOT NULL, 
             `newitem_name` varchar(120) NOT NULL, 
             `newitem_description` text NOT NULL, 
             `po_number` int(50) NOT NULL, 
             `quantity` int(50) NOT NULL,
             `delivery_date` datetime NOT NULL, 
             `receiver_name` varchar(120) NOT NULL, 
             `creater_id` int(10) NOT NULL, 
             `Creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ) 
              ENGINE=InnoDB DEFAULT CHARSET=latin1;";


      
  
    }


}

?>