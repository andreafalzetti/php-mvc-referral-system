<?php

class ImportController extends Controller {
    
    public function getAction() {        
        $view = new ImportView();
        $view->output();
    }
    
    public function postAction() {
        
        
        //echo "<pre>".print_r($_FILES["import_csv"],1)."</pre>";
        if(isset($_FILES['import_csv']['name'])) {
            $this->handleUpload();
        } elseif(isset($_POST['confirm_import'])) {
            $this->handleImport();
        } elseif(isset($_POST['random'])) {
            $this->random();
        }
    }
    
    public function random() {
        $random = (int)$_POST['random'];
        $view = new ImportView();
        //http://api.randomuser.me/?results=5000
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://api.randomuser.me/?results='.$random,
            CURLOPT_USERAGENT => 'Referral System by Andrea Falzetti'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $resp = json_decode($resp);
        //echo "<pre>".print_r($resp,1)."</pre>";    
        $clients = $resp->results;
        $saved = 0;
        foreach($clients as $random_client) {
            //echo "<pre>".print_r($random_client,1)."</pre>"; 
            $client = new Client();
            $client->setTitle(ucfirst($random_client->name->title));
            $client->setFirstName(ucfirst($random_client->name->first));
            $client->setLastName(ucfirst($random_client->name->last));
            $client->setDob(ucfirst($random_client->dob));
            $client->setEmail(ucfirst($random_client->email));
            $client->setMobile(ucfirst($random_client->cell));
            
            // Building Address object
            $address = array();
            $address["address_line_1"] = ucfirst($random_client->location->street);
            $address["address_line_2"] = ucfirst($random_client->location->street);
            $address["address_postcode"] = ucfirst($random_client->location->postcode);
            $address["address_city"] = ucfirst($random_client->location->city);
            $address["address_country"] = $random_client->nat;
            
            $client->setAddress(json_encode($address));
            $client->setNotes("");
            if($client->save()) {
                $saved++;
            }
        }
        
        $view->addData('message', $saved." random clients have been imported");
        $view->output();
        
    }
    
    public function handleUpload() {
        $view = new ImportView();
        $message = "";
        $upload_dir = __DIR__."/../upload/";
        $upload_file = $upload_dir.time()."_".basename($_FILES["import_csv"]["name"]);
        if (move_uploaded_file($_FILES["import_csv"]["tmp_name"], $upload_file)) {
            $message = "File uploaded successfully";
            $message_class = "alert alert-success";
            $view->setView('import_result.html');


            $csv = array_map('str_getcsv', file($upload_file));
            $view->addData('clients', $csv);
            echo "<pre>".print_r($csv,1)."</pre>";
        } else {
            $message = "Error uploading the file";
            $message_class = "alert alert-danger";
        }

        $view->addData('message', $message);
        $view->addData('message_class', $message_class);
        $view->output();
    }
    
    public function handleImport() {
        $view = new ImportView();
        $message = "";
        echo "<pre>".print_r($_POST,1)."</pre>";
        die();        
        foreach($client as $clients) {
            if($client['confirm_XX']) {
                $client = new Client();
                $client->setTitle($client['title']);
                $client->serFirstName($client['first_name']);
                $client->setLastName($client['last_name']);
                $client->setDob($client['dob']);
                $client->setEmail($client['email']);
                $client->setMobile($client['mobile']);
            }
        }
        $view->output();
    }
    
}