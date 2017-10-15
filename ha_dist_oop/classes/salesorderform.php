<?php
Class SalesOrderForm extends formAction{
    protected $_orderNr;
    
    public function AddNewRecord(){
        //get where to write in the Db  
        $this->_orderNr = $this->GetNewRecordNr('order_number', 'order_header');  
        //Document = header table + item table 
        if($this->SetHeaderItems()){
                $this->SetLineItems();
                return true;}
        else return false;
    }

    private function SetLineItems(){  
        //How many line item exists
        $lineitems      = round((input::Count()-4)/3);         
        //Pass line be line to the Db   
        for ($i = 1; $i <= $lineitems; $i++){            
             $lineItem = array(   
                       'order_number' => $this->_orderNr,
                       'line_item'    => input::get('lineItemNr'.$i),
                       'material'     => input::get('newSoMaterial'.$i),
                       'quantity'     => input::get('newSoQty'.$i));
            //print_r($lineItem); echo '<br/>';
            $this->_db->insert('order_lineitem', $lineItem);
        }        
    }

    private function SetHeaderItems(){
        $agent          = Session::get('user');
        $newSoPriority  = (Input::get('newSoPriority')) ? 1 : 0;
        $header = array(   
                       'order_number' => $this->_orderNr,
                       'customer'     => input::get('newSoCustomer'),
                       'agent'        => $agent,
                       'req_del_dat'  => input::get('newSoReq_del_date'),
                       'conf_del_date'=> 'NULL',
                       'status'       => '10',
                       'doc_type'     => 'SO',
                       'priority'     => $newSoPriority);
            //print_r($header); echo '<br/>';
            if($this->_db->insert('order_header', $header)) {
                return true;}
            else return $this->_db->error();           
    }


}

?>