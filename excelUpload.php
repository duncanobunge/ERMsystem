<?php
session_start();
if(!isset($_SESSION['user'])){

    header("Location:http://localhost/IMS/index.php");

}else{
require('php-excel-reader/excel_reader2.php');
require('SpreadsheetReader.php');
require('db_config.php');
if(isset($_POST['Submit']))
{
$mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
if(in_array($_FILES["file"]["type"],$mimes))
{
$uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
$Reader = new SpreadsheetReader($uploadFilePath);

$totalSheet = count($Reader->sheets());
echo "You have total ".$totalSheet." sheets";

$html="<table border='1'>";
$html.="<tr>
<th>Item Description</th>
<th>Delivery Date</th>
<th>Supplier</th>
<th>P.O No</th>
<th>Qty Received</th>
<th>UoM</th>
<th>Remarks</th></tr>";

/* For Loop for all sheets */
for($i=0;$i<$totalSheet;$i++)
{
$Reader->ChangeSheet($i);
        foreach ($Reader as $Row)
        {
        $html.="<tr>";
        $item_description=isset($Row[0]) ? $Row[0] : '';
        $delivery_date = isset($Row[1]) ? $Row[1] : '';
        $item_supplier=isset($Row[2]) ? $Row[2] : '';
        $po_number = isset($Row[3]) ? $Row[3] : '';
        $quantity = isset($Row[4]) ? $Row[4] : '';
        $uom = isset($Row[5]) ? $Row[5] : '';
        $remarks = isset($Row[6]) ? $Row[6] : '';
        $html.="<td>".$item_description."</td>";
        $html.="<td>".$delivery_date."</td>";
        $html.="<td>".$item_supplier."</td>";
        $html.="<td>".$po_number."</td>";
        $html.="<td>".$quantity."</td>";
        $html.="<td>".$uom."</td>";
        $html.="<td>".$remarks."</td>";
        $html.="</tr>";

       // echo  $item_description;
       // echo  $delivery_date;

        $query="INSERT INTO delivereditems_tbl(item_id,item_supplier,item_description,po_number,quantity,uom,delivery_date,remarks,creater_id,creation_date)
                VALUES('','$item_supplier','$item_description','$po_number','$quantity','$uom','$delivery_date','$remarks','4',CURRENT_TIMESTAMP)";
   mysqli_query($con,$query) or die(mysqli_error($con));
                
        }
}
$html.="</table>";
echo("<script>location.href='newlydelivereditems.php';</script>");
}
else
{
//die("<br/>);
echo '<script language="javascript">';
echo 'alert("Sorry, File type is not allowed. Only Excel file.")';
echo '</script>';
echo("<script>location.href = 'newlydelivereditems.php';</script>");
}
}}
?>