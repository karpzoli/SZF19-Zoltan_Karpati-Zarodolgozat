<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Customer list</title>
    <script src="./core/popup.js"></script> 
</head>
<body>

<?php
require_once 'core/init.php';
include_once('header.php');
$form = new FormAction();

if (Input::exists()){   
}
?>

<h3>List of Customers</h3>

<table width="80%" class="pure-table">
<thead><th>Selected</th><th>Number</th><th>Type</th><th>Name</th><th>Rep</th><th>HUB</th><th>Rate</th></thead>
<tr><input type="submit" name="okButton" value="Insert" class="button-secondary pure-button"/></tr>
<tr>
<?php
$items     = $form->GetAllRecords('customer', array('number', '>', '0'));
$checked = false;
foreach ($items as $item){
     ?>    
    <form action="" method="POST">
    <input type="hidden" name="number" value="<?php $item->number ?>">
    <tr>    
    <td><input type="checkbox" name="selected"></td>
    <td><?php echo $item->number                                                            ?></td>
    <td><?php if($item->type = " ") echo "N/A"; else echo $item->type                       ?></td>
    <td><?php echo $item->name                                                              ?></td>
    <td><?php if(empty($item->representative)) echo "N/A"; else echo $item->representative  ?></td>
    <td><?php echo $item->hub                                                               ?></td>
    <td><?php echo $item->rate                                                              ?></td>    	
    </tr>    
    </form> 
<?php } ?>
</body>
</html>