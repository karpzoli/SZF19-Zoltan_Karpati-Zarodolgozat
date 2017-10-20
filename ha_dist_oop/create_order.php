<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Create SO</title>
    <script src="./core/popup.js"></script>
    <link rel="stylesheet" href="./core/mainStyle.css">   
</head>
<body>

<?php
require_once 'core/init.php';
include_once 'header.php';
$form = new SalesOrderForm();

if(Input::exists()){ 
    //var_dump(Input::GetAll()); echo '<br />';
   if($form->AddNewRecord()) {
    echo '<div><br/><a href="so_management.php?user='.escape($user->data()->username).'" target="_parent"><button type="button" class="button-success pure-button">Sales Order creation was successful! Click Here to return!</button></a></div>';}
   Cookie::delete('customerSelect');
   Cookie::delete('materialSelect');
   }

?>

<h2>Create Sales Order</h2>
<form name="CreateNewsSO" method="POST" >
   <input type="submit" name="CreateNewSoButton" value="Create" class="button-success pure-button">
   <input type="button" onclick="CancelNewElement()"  value="Cancel" class="button-warning pure-button">
   <button type="reset" class="button-secondary pure-button">Reset</button>

   <table id="" width="" class="pure-form pure-form-stacked">    
    <body onLoad="AddNewLineItem()">
    <tr><th>Customer</th>
        <td><input type="number" name="newSoCustomer" value="<?php 
                                                                   if(Input::exists()) echo Input::get('number') ;
                                                                   if(Cookie::exists('customerSelect')) echo Cookie::get('customerSelect');                                                                        
                                                             ?>" required></td>
        <td> <button class="pure-menu-item"><a href="./customerlist.php" class="pure-menu-link"> List </a></button></td>         
    </tr>       
    <tr> 
        <th>Req.Del.Date</th><td><input type="date" name="newSoReq_del_date"required></td>
        <th>Priority</th><td><input type="checkbox" name="newSoPriority"></td>             
    </tr>         
    <tr>        
        <th><input type="button" onclick="AddNewLineItem()" value="Add New line" class="pure-button pure-button-secondary"></th>
        <th><input type="button" class="button-error pure-button" onClick="DeleteLineItem()" value="Delete Last Line"</th>  
        <th><input type="button" name="ON" class="button-success pure-button" onClick="" value="Material List ON"</th>  
    </tr>
    </table>   
    <table id="CreateNewElementTable" class="pure-form pure-form-stacked">
    </table>   
   
      </body>      
     </table> 
</form>         
<div ><iframe id="materialList" src="./materiallist.php"></iframe></div>
    
</body>
</html>