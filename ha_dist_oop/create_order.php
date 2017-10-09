<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Create SO</title>
    <script src="./core/popup.js"></script>   
</head>
<body>

<?php
require_once 'core/init.php';
include_once 'header.php';
$form = new SalesOrderForm();

?>

<h2>Create Sales Order</h2>
<form name="CreateNewsSO" method="POST" >
   <input type="submit" name="CreateNewSoButton" value="Create" class="button-success pure-button">
   <input type="button" onclick="CancelNewElement()"  value="Cancel" class="button-warning pure-button">
   <button type="reset" class="button-secondary pure-button">Reset</button>
   <table id="CreateNewElementTable" class="pure-form pure-form-stacked">    
    <body onLoad="AddNewLineItem()">
    <tr><th>Customer</th>
        <td><input type="number" name="newSoCustomer" required></td>
        <td><input type="button" name="newSoCustomerSelectButton" value="List" class="button-secondary pure-button"></td> 
        <td id="customerNameLabel"></td>
    </tr>       
     <tr> 
        <th>Req.Del.Date</th><td><input type="date" name="newSoReq_del_date"required></td>
        <th>Priority</th><td><input type="checkbox" name="newSoPriority"></td>       
      
     </tr>
      <!--Line item part-->
      <tr>
        <th>Item Nr.</th><th colspan="2">Material</th><th>Quantity</th>
        <th><input type="button" onclick="AddNewLineItem()" value="Add New line" class="pure-button pure-button-secondary"></th>
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