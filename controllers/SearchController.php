<?php

class SearchController extends Controller {
    
    public function getAction() {
            
        $view = new SearchView();
        
        if(isset($_GET["q"]) && $_GET["q"] != "") {
            $q = addslashes(htmlspecialchars($_GET["q"]));    
            
            if($q) {
                
                $clients = ClientQuery::create()
                        ->filterByLastName("%".$q."%")
                        ->_or()
                        ->filterByFirstName("%".$q."%")
                        ->_or()
                        ->filterByNotes("%".$q."%")
                        ->orderByLastName('asc')
                        ->find();
                                    
                $view->addData('q', $q);
                $view->addData('clients', $clients->toArray());                                
            }            
        }                
        
        $view->output();
    }
    
}