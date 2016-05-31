<?php

class ClientController extends Controller {
    
    public function postAction() {
        
        $view = new ClientView();
        $title = htmlspecialchars($_POST['title']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $dob = htmlspecialchars($_POST['dob']);
        $email = htmlspecialchars($_POST['email']);
        $mobile = htmlspecialchars($_POST['mobile']);
        $address_line_1 = htmlspecialchars($_POST['address_line_1']);
        $address_line_2 = htmlspecialchars($_POST['address_line_2']);
        $address_postcode = htmlspecialchars($_POST['address_postcode']);
        $address_city = htmlspecialchars($_POST['address_city']);
        $address_country = htmlspecialchars($_POST['address_country']);
        $notes = htmlspecialchars($_POST['notes']);
                
        // Building Address object
        $address = array();
        $address["address_line_1"] = $address_line_1;
        $address["address_line_2"] = $address_line_2;
        $address["address_postcode"] = $address_postcode;
        $address["address_city"] = $address_city;
        $address["address_country"] = $address_country;        
        
        $id = $this->getId();
        if($id !== "" && $id >= 0) {
            $q = new ClientQuery();    
            $client = $q->findPK($id);
        } else {
            // New Client
            $client = new Client();
        }
        
        $client->setTitle($title);
        $client->setFirstName($first_name);
        $client->setLastName($last_name);
        $client->setDob($dob);
        $client->setEmail($email);
        $client->setMobile($mobile);
        $client->setAddress(json_encode($address));
        $client->setNotes($notes);

        $hasError = false;
        
        if(!isset($_POST['first_name']) || empty($_POST['first_name'])) {
            $hasError = "Please enter the First Name";
        }
        else if(!isset($_POST['last_name']) || empty($_POST['last_name'])) {
            $hasError = "Please enter the Last Name";
        }
        else if(!isset($_POST['email']) || empty($_POST['email'])) {
            $hasError = "Please enter the Email";
        }   
        
        if($hasError) {
            $view->addData('message', $hasError);
            $view->addData('message_class', "alert alert-danger");
            $view->addData('client', $client);
            $view->output();
            return;
        }
        
        if($client) {
           
            $result = $client->save();
            
            if($result) {
                $view->addData('message', "Client saved successfully");
                $view->addData('message_class', "alert alert-success");
                //$client_array['Address'] = json_decode($client_array['Address']);                    
                $view->addData('client', $client);
                $view->output();
            }  
            
        } else {
            
            $view->setView('error.html');
            $view->addData('message', 'Problem in saving the client');
            
        }
        
    }
    
    public function getAction() {
        
        $view = new ClientView();
        
        if($this->isNew()) {
            $view->addData('title', 'Add New Client');            
            $view->output();
        } else {
            $id = $this->getId();
            if($id !== "" && $id >= 0) {
                $q = new ClientQuery();    
                $client = $q->findPK($id);
                if($client) {
                    $client_array = $client->toArray();
                    $client_array['Address'] = json_decode($client_array['Address']);                    
                    $view->addData('client', $client_array);
                } else {
                    $view->setView('error.html');
                    $view->addData('message', 'Client not found');
                }
                //print_r($client->toArray());
                
            } else {
               //$data = ClientQuery::create()
                 //       ->orderByLastName()
                   //     ->limit(10)
                     //   ->find();
            }
            $view->addData('title', 'Edit Client');
            $view->output();
            //echo $data->toJSON();
        }   
    }
    
    public function putAction() {
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        $client_id = $this->getId();
        $user_id = (int)$_SESSION['user_id'];        
        $status = $data->status;        
        if($client_id !== "" && $client_id >= 0 && $status && $user_id > 0) {
            
            $query = ReviewQuery::create()
                         ->filterByUserId($user_id)
                         ->filterByClientId($client_id)
                         ->limit(1)
                         ->find();

            if(count($query->toArray()) == 0) {
                $review = new Review();
                $review->setClientId($client_id);
                $review->setUserId($user_id);    
                $review->setMessage("");
            } else {
                $review = $query[0];
            }
            
            $review->setStatus($status);
            $result = $review->save();
            if($result) {
                echo json_encode(array('result' => true));
            } else {
                echo json_encode(array('result' => false));
            }
                
        } else {
            die("NF");
        }
    }

}