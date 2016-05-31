<?php

class View {
    
    protected $view_name = 'index.html';
    protected $loader;
    protected $twig;
    protected $template;
    protected $data;
    
    function __construct() {
        $this->loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
        $this->twig = new Twig_Environment($this->loader, array(
                'cache' => false,//'/Applications/MAMP/htdocs/referral-system/cache',
        ));
        $this->template = $this->twig->loadTemplate($this->view_name);
        $this->data = array();
    }
    
    function setView($view_name) {
        $this->view_name = $view_name;
        $this->template = $this->twig->loadTemplate($this->view_name);
    }
    
    function beforeOutput() {
        
    }
    
    function addData($key, $value) {
        $this->data[$key] = $value;
    }
    
    function output() {        
        $this->beforeOutput();
        echo $this->template->render($this->data);
    }
    
}