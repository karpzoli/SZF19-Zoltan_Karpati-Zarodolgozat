<?php
Class POForm extends formAction{
    protected $_orderNr;
    
    public function AddNewRecord(){
        $order_number            = Input::get('selected');
        $delivery_date           = Input::get('delivery_date');
        $this->_orderNr = $this->GetNewRecordNr('po_number', 'po_header');          
        if($this->SetHeaderItems()){
                $this->SetLineItems();
                $this->UpdateDocStatus($order_number, 'order_header', array('status' => '11'));
                $this->UpdateDocStatus($order_number, 'order_header', array('conf_del_date' => $delivery_date));
                return true;}
        else return false;
    }

    private function SetLineItems(){                  
        $lineitems               = count(Input::get('selected')); 
        $order_number            = Input::get('selected');        
        $item                    = 1;
 
        for ($i = 0; $i < $lineitems; $i++){      
               $lineItem = array(
                       'po_number'    => $this->_orderNr,   
                       'line_item'    => $item,
                       'order_number' => $order_number[$i]);                                   
            $this->_db->insert('po_lineitem', $lineItem);
            $item++;
         }       
    }

    private function SetHeaderItems(){
        $agent          = Session::get('user');        
        $header = array(   
                       'po_number'      => $this->_orderNr,                       
                       'agent'          => $agent,
                       'doc_type'       => 'PO',
                       'status'         => '20',                       
                       'delivery_date'  => Input::get('delivery_date'));            
            if($this->_db->insert('po_header', $header)) {return true;}
            else return false;           
    }    

    public function DeleteWithUpdate($selecteditem){         
         $tmp_order_number       = $this->GetRecordField('po_lineitem', 'order_number', array('po_number','=',$selecteditem)); 
         $lineitems              =  count($tmp_order_number);
      
          for ($i = 0; $i < $lineitems; $i++){      
               $order_number     = (array)$tmp_order_number[$i]; 
               $this->UpdateDocStatus($order_number, 'order_header', array('status' => '10'));
               $this->UpdateDocStatus($order_number, 'order_header', array('conf_del_date' => 'NULL'));
          } 

         if($this->DeleteRecord('po_header',array('po_number','=', $selecteditem))) {
                $this->DeleteRecord('po_lineitem', array('po_number','=', $selecteditem));
          }
    }
    
}
?>