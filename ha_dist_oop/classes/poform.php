<?php
Class POForm extends formAction{
    protected $_orderNr;
    
    public function AddNewRecord(){
        //get where to write in the Db  
        $this->_orderNr = $this->GetNewRecordNr('po_number', 'po_header');          
        if($this->SetHeaderItems()){
                $this->SetLineItems();
                //$this->SetSOStatus();
                return true;}
        else return false;
        //$this->SetHeaderItems();
        //$this->SetLineItems();
    }

    private function SetLineItems(){                  
        $lineitems      = count(Input::get('selected'));       
        $item           = 1;
        $selected       = Input::get('selected');
        $wtf            = Input::get('order_number');        
        for ($i = 0; $i < $lineitems; $i++){  
            if($selected[$i] == 'on') {
               $lineItem = array(
                       'po_number'    => $this->_orderNr,   
                       'line_item'    => $item,
                       'order_number' => $wtf[$i]);                                              
                $item++;}
            echo 'line item <br/>'; print_r($lineItem); echo '<br/>';
            $this->_db->insert('po_lineitem', $lineItem);
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
            echo 'header'.'<br/>'; print_r($header); echo '<br/>';
            if($this->_db->insert('po_header', $header)) {return true;}
            else return false;           
    }    

    private function SetSOStatus(){
        
}
}
?>