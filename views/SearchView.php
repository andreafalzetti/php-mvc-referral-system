<?php

class SearchView extends View {
    
    protected $view_name = "search.html";
    protected $data = array();
    
    function __construct() {
        parent::__construct();
        $this->setView($this->view_name);
    }
    
    function beforeOutput() {
        if(isset($this->data['clients'])) {
            foreach($this->data['clients'] as $index => $client) {
                if(isset($client['Address']) && gettype($client['Address']) == "string") {
                    $this->data['clients'][$index]['Address'] = json_decode($client['Address']);
                }
            }
        }
    }
    
}