<?php

class UserController extends Controller {
    
    public function login($user_id) {
        $_SESSION["user_id"] = $user_id;
    }
    
    public function getLoggedId() {
        if(isset($_SESSION['user_id'])) {
            return (int)$_SESSION['user_id'];
        } else {
            return -1;
        }
    }
    
    public function create() {
        $users = UserQuery::create()
                ->find();
        if(!count($users->toArray())) {
            $user = new User();
            $user->setEmail("afalzetti@gmail.com");
            $user->setPassword(md5("andrea"));
            if($user->save()) {
                $_SESSION['user_id'] = $user->getId();   
            }            
        }        
    }
    
}