<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />     
    <title>PO Management</title>        
</head>
<body>

<!--NAVIGATION-->
<?php
require_once 'core/init.php';
include_once('header.php');
$form = new POForm();

if (Input::exists()){    
	$button         = Input::get('okButton');
    $selecteditem   = Input::get('id');

        if($button == "Details"){
            
        }
        if($button == "Delete"){ 
            $form->DeleteWithUpdate($selecteditem  );    
            }
        }

?>

<h2>Sales Order Management</h2>

<a href="create_po.php" target="_parent"><button type="button" class="pure-button pure-button-primary">Create New PO</button></a>

<h3>List Of Purchase Orders</h3>

<table width="50%" class="pure-table">
<thead><th>PO #</th><th>Status</th><th>Delivery Date</th><th>Agent</th><th></th></thead>
<tr>
<?php
$Items     = $form->GetAllRecords('po_header', array('po_number', '>', '0'));

foreach ($Items as $item)
{   $agentName      = $form->GetRecordField('users', 'username', array('id','=', $item->agent));
    $statusName      = $form->GetRecordField('status', 'name', array('status_id','=', $item->status));
    ?>    
    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $item->po_number ?>">
    <tr>
    <td><?php echo $item->po_number           ?></td>
    <td><?php echo $statusName[0]->name       ?></td>
    <td><?php echo $item->delivery_date       ?></td>
    <td><?php echo $agentName[0]->username    ?></td>     
    <td>  	
    <input type="submit" name="okButton" value="Details" class="button-secondary pure-button"/>
    <input type="submit" name="okButton" value="Delete" class="button-error pure-button" onClick="return confirm('Are you sure you want to delete PO: <?php echo $item->po_number ?>  ?')">
    </td>  
	</form> 
    </tr>    
<?php } ?>
 
</body>
</html>
