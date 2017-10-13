<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Customer list</title>    
</head>
<body>

<?php
require_once 'core/init.php';
include_once('header.php');
$form = new FormAction();
$items     = $form->GetAllRecords('customer', array('number', '>', '0'));
?>

<h3>List of Customers</h3>

<table width="80%" class="pure-table">
<thead><th></th><th>Number</th><th>Type</th><th>Name</th><th>Rep</th><th>HUB</th><th>Rate</th></thead>
<tr>
<?php
foreach ($items as $item){
     ?>    
    <form action="" method="POST" class="pure-form pure-form-aligned">
    <input type="hidden" name="number" value="<?php $item->number ?>">
    <tr>        
    <td><input type="submit" name="select" value="select" class="button-secondary pure-button" onClick="return confirm('Customer // <?php echo $item->name ?> // was selected ')"></td>
    <input type="hidden" name="customer" id="customer" value="<?php echo $item->number  ?>">
    <td><?php echo $item->number                                                            ?></td>
    <td><?php if($item->type = " ") echo "N/A"; else echo $item->type                       ?></td>
    <td><?php echo $item->name                                                              ?></td>
    <td><?php if(empty($item->representative)) echo "N/A"; else echo $item->representative  ?></td>
    <td><?php echo $item->hub                                                               ?></td>
    <td><?php echo $item->rate                                                              ?></td>    	
    </tr>    
    </form> 
<?php } 
if (Input::exists()){      
    Cookie::put('customerSelect', Input::get('customer'), 90);      
    Redirect::to('create_order.php?user='.escape($user->data()->username));
}
?>
</body>
</html>