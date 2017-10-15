<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />     
    <title>SO Management</title>        
</head>
<body>

<!--NAVIGATION-->
<?php
require_once 'core/init.php';
include_once('header.php');
$form = new SalesOrderForm();

if (Input::exists()){    
	$button         = Input::get('okButton');
    $selecteditem   = Input::get('id');

        if($button == "Details"){
            
        }
        if($button == "Delete"){            
            if($form->DeleteRecord('order_header',array('order_number','=', $selecteditem))) {
                $form->DeleteRecord('order_lineitem', array('order_number','=', $selecteditem));
            }
        }
}

?>

<h2>Sales Order Management</h2>

<a href="create_order.php" target="_parent"><button type="button" class="pure-button pure-button-primary">Create Sales Order</button></a>

<h3>Sales Order Created by me</h3>

<table width="100%" class="pure-table">
<thead><th>Order #</th><th>Customer</th><th>Customer Name</th><th>Requested Del</th><th>Confirmed Del</th><th>Status</th><th>Priority</th></thead>
<tr>
<?php
$orders     = $form->GetAllRecords('order_header', array('agent', '=', $_SESSION['user']));

foreach ($orders as $order)
{  $custName        = $form->GetRecordField('customer', 'name', array('number','=', $order->customer));
   $statusName      = $form->GetRecordField('status', 'name', array('status_id','=', $order->status));
     ?>    
    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $order->order_number ?>">
    <tr>
    <td><?php echo $order->order_number           ?></td>
    <td><?php echo $order->customer               ?></td>
    <td><?php echo $custName[0]->name             ?></td>
    <td><?php echo $order->req_del_dat            ?></td>
    <td><?php echo $order->conf_del_date          ?></td>
    <td><?php echo $statusName[0]->name           ?></td>
    <td><?php echo ($order->priority)? 'yes':'no' ?></td>
    <!--Buttons at the end of each record-->
    <td>  	
    <input type="submit" name="okButton" value="Details" class="button-secondary pure-button"/>
    <input type="submit" name="okButton" value="Delete" class="button-error pure-button" onClick="return confirm('Are you sure you want to delete SO: <?php echo $order->order_number ?>  ?')">
    </td>  
	</form> 
    </tr>    
<?php } ?>
 



</body>
</html>
