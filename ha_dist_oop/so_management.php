<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <!--<link href="/ha_dist/assets/popup.css" rel="stylesheet"> -->  
    <title>SO Management</title>
    <script src="/ha_dist/assets/popup.js"></script>    
</head>
<body>

<!--NAVIGATION-->
<object height="40" data="nav_header.html"></object>


<h1>Sales Order Management</h1>

<?php 
//if user is not demand planner or admin
if((@$_COOKIE['ha_dist_role']!=2) && (@$_COOKIE['ha_dist_role']!=5))  die("No authorization to this page - or expired logon!"); 
if(!isset($_COOKIE['ha_dist_id'])) die("Error with user!"); 
require_once("./connect.php");
db_connect();
?>


<!-- creating sales order -->
<h3>Create Sales Order</h3>
<input type="button" onClick="CreateNewElement()" value="Create Sales Order" />
<!--entry panel hidden by default-->
<div id="backGround"> 
<div id="entryWindow"> 
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
</div>
</div>
<div id="customerListWindow"></div>

<?php 
if(isset($_POST['CreateNewSoButton'])){
    $agent=$_COOKIE['ha_dist_id'];	
   
    $newSoPriority = (isset($_POST['newSoPriority'])) ? 1 : 0; 

    //https://stackoverflow.com/questions/9798188/get-the-largest-number-in-a-mysql-database-in-php
    $rowSQL = mysql_query( 'SELECT MAX(order_number) AS max FROM order_header;' );
    $row = mysql_fetch_array( $rowSQL );
    $newOrderNr = $row['max']+1;
    
    
    extract($_POST); //echo print_r($_POST);
    $writeDbValues=""; 
    //echo  count($_POST);
    for ($i = 1; $i <= (count($_POST)-3)/3; $i++) //$i gives the number of line items user added
    { 
        $writeDbValues.="('$newOrderNr', '${'lineItemNr'.$i}', '${'newSoMaterial'.$i}', '${'newSoQty'.$i}'), ";  
    }
    $writeDbValues=rtrim($writeDbValues,", ");
    //$writeDb="BEGIN; 
    //         INSERT INTO order_header (customer, agent, req_del_dat, status, doc_type, priority) 
    //            VALUES ('$newSoCustomer', '$agent', '$newSoReq_del_date', '10','SO','$newSoPriority');
    //         INSERT INTO order_lineitem (line_item, material, quantity) 
    //            VALUES ($writeDbValues);
    //         COMMIT;";             

    $writeDbHead="INSERT INTO order_header (order_number, customer, agent, req_del_dat, status, doc_type, priority) 
                VALUES ('$newOrderNr', '$newSoCustomer', '$agent', '$newSoReq_del_date', '10','SO','$newSoPriority');";
    mysql_query($writeDbHead) or die(mysql_error());

    $writeDbLine="INSERT INTO order_lineitem  
             VALUES $writeDbValues;";    
    mysql_query($writeDbLine) or die(mysql_error());
    //echo $writeDbHead ; echo '<br/>'; echo $writeDbLine;
}
?>

</body>
</html>