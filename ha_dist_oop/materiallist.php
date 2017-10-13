<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Material list</title>  
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">    
</head>
<body>

<?php
require_once 'core/init.php';
//include_once('header.php');
$form = new FormAction();
$items     = $form->GetAllRecords('material', array('status', '=', '50'));
?>

<table width="100%" class="pure-table">
<thead><th></th><th>Code</th><th>Name</th></thead>
<tr>
<?php
foreach ($items as $item){
     ?>    
    <form action="" method="POST" class="pure-form pure-form-aligned">
    <input type="hidden" name="number" value="<?php echo $item->id ?>">
    <tr>        
    <td><input type="submit" name="Insert" value="Insert" class="button-secondary pure-button" ></td>
    <input type="hidden" name="material" id="material" value="<?php echo $item->id             ?>">
    <td><?php echo $item->id                                                                   ?></td>    
    <td><?php echo $item->name                                                                 ?></td>        
    </tr>    
    </form> 
<?php } 
if (Input::exists()){      
    Cookie::put('materialSelect', Input::get('material'), 90);          
}
?>
</body>
</html>