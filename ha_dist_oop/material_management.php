<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />     
    <title>Material Management</title>        
</head>
<body>

<!--NAVIGATION-->
<?php
require_once 'core/init.php';
include_once('header.php');
$form = new MaterialForm();

if (Input::exists()) {    
    $form->FormUpdate();        
    //Redirect::to('material_management.php?user='.escape($user->data()->username));
}
?>

<h2>Sales Order Management</h2>

<a href="create_material.php" target="_parent"><button type="button" class="pure-button pure-button-primary">Create New Material</button></a>

<h3>Material list</h3>

<table width="100%" class="pure-table">
<thead><th>Material Code</th><th>Name</th><th>Price</th><th>Status</th></thead>

<?php
$materials     = $form->GetAllRecords('material', array('id', '>', '0'));

foreach ($materials as $material)
{   $statusName      = $form->GetRecordField('status', 'name', array('status_id','=', $material->status));
    ?>    
    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $material->id ?>">
    <tr>
    <td><?php echo $material->id              ?></td>
    <td><?php echo $material->name            ?></td>    
    <td><?php echo $material->price           ?></td>
    <td><?php echo $statusName[0]->name       ?></td>
    <!--Buttons at the end of each record-->
    <td>  	
    <?php
        if($material->status=='50') 
              {?><input type="submit" name="okButton" value="Deactivate" class="button-warning pure-button"/> <?php }
        else { ?> <input type="submit" name="okButton" value="Activate" class="button-success pure-button"/>  <?php }
    ?>
    <input type="submit" name="okButton" value="Delete" class="button-error pure-button" onClick="return confirm('Are you sure you want to delete material: <?php echo $material->id ?>  ?')">                                                                                         
    </td>                                                                                 
    </tr>    
	</form> 


<?php } ?>
</table>
</body>
</html>
