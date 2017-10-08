<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Create SO</title>
    <script src="/ha_dist_oop/assets/popup.js"></script>    
</head>
<body>

<?php
require_once 'core/init.php';
include_once 'header.php';
$form = new SalesOrderForm();

?>

<h2>Create Sales Order</h2>
<form name="CreateNewsSO" method="POST">
   <table id="CreateNewElementTable" class="FormEntryTable" border="1">    
    <body onLoad="AddNewLineItem()">
    <tr><td>Customer</td>
        <td><input type="number" name="newSoCustomer" required></td>
        <td><input type="button" name="newSoCustomerSelectButton" value="List"></td> 
        <td id="customerNameLabel"></td>
    </tr>       
     <tr> 
        <td>Req.Del.Date</td><td><input type="date" name="newSoReq_del_date"required></td>
        <td>Priority</td><td><input type="checkbox" name="newSoPriority"></td>       
        <td><input type="submit" name="CreateNewSoButton" value="Create"></td>
        <td><input type="button" onclick="CancelNewElement()"  value="Cancel"></td>
        <td><button type="reset">Reset</button></td>        
     </tr>
      <!--Line item part-->
      <tr>
        <td>Item Nr.</td><td>Material</td><td>Quantity</td>
        <td><input type="button" onclick="AddNewLineItem()" value="Add New line"></td>
      </tr>   
      </body>      
     </table> 
</form>         

<?php 
if(Input::exists()){ 
   if($form->AddNewRecord()) echo '<div name="ConfirmMsg">Sales Order creation was successful</div> ';
   }
?>

</body>
</html>