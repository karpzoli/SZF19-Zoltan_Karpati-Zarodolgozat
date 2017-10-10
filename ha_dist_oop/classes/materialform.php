<?php
Class MaterialForm extends formAction{

public function SetItem(){                
        $material = array(   
                       'name'   => input::get('material_name'),
                       'price'           => input::get('price'),
                       'status'          => '50');                             
        $this->_db->insert('material', $material);
        return $this->_db->error();           
    }

public function FormUpdate(){        
    $button=Input::get('okButton');
    $toBeModified=Input::get('material_code');    
    switch($button){
        case 'Deactivate' : 
            $this->_db->update('material', $toBeModified, array('status' => '51'));   
            break;
        case 'Activate' : 
            $this->_db->update('material', $toBeModified, array('status' => '50'));   
            break;
        case 'Delete' : 
            $this->_db->delete('material', array('material_code', '=', $toBeModified));
            break;
    }    
}
}
?>