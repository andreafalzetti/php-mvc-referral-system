<?php

class ImportView extends View {

    protected $view_name = 'import.html';
    protected $data = array();

    function __construct() {
        parent::__construct();
        $this->setView($this->view_name);
    }    
    
}