<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Create PO</title>
    <script src="./core/popup.js"></script>   
</head>
<body>

<?php
require_once 'core/init.php';
include_once 'header.php';
$form = new POForm();

?>
<h2>Create PO - Select from 'open' SO</h2>

<form action="" method="POST" class="pure-form">
<input type="submit" class="button-success pure-button" value="Create PO"><br/>
<table width="100%" class="pure-table">
<thead><th>Select</th><th>Order #</th><th>Customer</th><th>Customer Name</th><th>Requested Del</th><th>Status</th><th>Priority</th></thead>

<tr><legend for="delivery_date">Delivery Date <input type="date" name="delivery_date" required/></legend> </tr>

<?php
$orders     = $form->GetAllRecords('order_header', array('status', '=', '10'));
foreach ($orders as $order)
{  $custName        = $form->GetRecordField('customer', 'name', array('number','=', $order->customer)); 
   $statusName      = $form->GetRecordField('status', 'name', array('status_id','=', $order->status));
     ?>    
<form action="" method="POST" class="pure-form">    
    <input type="hidden" name="order_number[]" id="order_number[]" value="<?php echo $order->order_number ?>" />
    <tr>
        <td><input type="checkbox" name="selected[]"></td>
        <td><?php echo $order->order_number           ?></td>
        <td><?php echo $order->customer               ?></td>
        <td><?php echo $custName[0]->name             ?></td>
        <td><?php echo $order->req_del_dat            ?></td>    
        <td><?php echo $statusName[0]->name           ?></td>
        <td><?php echo ($order->priority)? 'yes':'no' ?></td>    
        <td><input type="button" name="okButton" value="Details" class="button-secondary pure-button"/></td>
    </tr>    
<?php } ?>
</table>
</form> 
<?php 
if(Input::exists()){ 
    //echo 'POST:'; echo print_r($_POST); echo '<br />';
    if($form->AddNewRecord()) echo '<p>PO Creation was successful</p>';
    else echo '<p>Error during PO creation!</p>';
   }
?>

</body>
</html>