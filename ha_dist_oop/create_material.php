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
$form = new MaterialForm();
$USER = new User();

?>

<h2>Create New Material</h2>
<form action="" method="post" class="pure-form pure-form-aligned">
   <fieldset>
    <div class="pure-control-group">
        <label for="material_name">Material Name</label>
        <input type="text" name="material_name" id="material_name" maxlength="40" value="<?php echo escape(Input::get('material_name')); ?>">
    </div>
    <div class="pure-control-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="<?php echo escape(Input::get('price')) ?>">
    </div>
        <div class="pure-control-group">
        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="Live" readonly>
    </div>
    <input type="submit" value="Create" class="pure-button pure-button-primary">
    </fieldset>
</form>       

<?php 
if(Input::exists()){ 
   $form->SetItem();
   ?> 
    <script type="text/javascript"> Alerting(); </script> 
   <?php
   Redirect::to('material_management.php?user='.escape($user->data()->username));  
   }
    
?>

</body>
</html>