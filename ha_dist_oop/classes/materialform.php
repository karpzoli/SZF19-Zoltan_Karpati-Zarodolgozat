<?php
Class MaterialForm extends formAction{

public function SetItem(){                
        $material = array(   
                       'name'            => input::get('material_name'),
                       'price'           => input::get('price'),
                       'status'          => '50');                             
        $this->_db->insert('material', $material);
        return $this->_db->error();           
    }

public function FormUpdate(){        
    $button=Input::get('okButton');
    $toBeModified=Input::get('id');  
    
    switch($button){
        case 'Deactivate' :             
            if(!$this->_db->update('material', $toBeModified, array('status' => '51'))){
                echo 'There was a problem updating';}   
            break;
        case 'Activate' :             
             if(!$this->_db->update('material', $toBeModified, array('status' => '50'))){
                echo 'There was a problem updating';} 
            break;
        case 'Delete' : 
            $this->_db->delete('material', array('id', '=', $toBeModified));
            break;
    }    
}
}
?>