<?php

class ClientView extends View {
    
    protected $view_name = "client.html";
    protected $data = array();
    
    function __construct() {
        parent::__construct();
        $this->setView($this->view_name);
    }
    
    function beforeOutput() {
        //$this->data['title'] = 'Add New Client';
        if(isset($this->data['client']) && gettype($this->data['client']) == "object") {
            $this->data['client'] = $this->data['client']->toArray();
        }
        if(isset($this->data['client']['Address']) && gettype($this->data['client']['Address']) == "string") {
            $this->data['client']['Address'] = json_decode($this->data['client']['Address']);
        }            
    }
    
}