<?php

use Propel\Runtime\Propel;

class Controller {
    
    public function getAction() {    
        
        // Pagination
        $referredPage = 1;
        if(isset($_GET['referred'])) {
            $referredPage = (int)$_GET['referred'];   
        }
        
        $acceptedPage = 1;
        if(isset($_GET['accepted'])) {
            $acceptedPage = (int)$_GET['accepted'];   
        }
        
        $rejectedPage = 1;
        if(isset($_GET['rejected'])) {
            $rejectedPage = (int)$_GET['rejected'];   
        }
        
        // Init the view
        $view = new View();
        
        // Fetch the "referred" clients
        $data = $this->fetchDataByStatus(0, $referredPage);
        
        // Adding the items to the view
        $view->addData("clients_referred", $data['items']);
        
        // Calculating the number of pages with 5 items per page
        $totalPages = ceil($data['total']/5);
        $view->addData("currentPageReferred", $referredPage);
        $view->addData("totalPagesReferred", $totalPages);
        
        // Fetch the "accepted" clients
        $data = $this->fetchDataByStatus(1, $acceptedPage);
        $view->addData("clients_accepted", $data['items']);
        $totalPages = ceil($data['total']/5);
        $view->addData("currentPageAccepted", $acceptedPage);
        $view->addData("totalPagesAccepted", $totalPages);
        
        // Fetch the "rejected" clients
        $data = $this->fetchDataByStatus(-1, $rejectedPage);
        $view->addData("clients_rejected", $data['items']);
        $totalPages = ceil($data['total']/5);
        $view->addData("currentPageRejected", $rejectedPage);
        $view->addData("totalPagesRejected", $totalPages);
        
        $view->output();
    }
    
    protected function isNew() {
        $query_string = htmlspecialchars($_SERVER['QUERY_STRING']);
        $query_string = explode('=', $query_string);
        $query_string = $query_string[1];
        $query_string = explode('/', $query_string);
        return (end($query_string) == "new");                
    }
    
    protected function getId() {
        $query_string = htmlspecialchars($_SERVER['QUERY_STRING']);
        $query_string = explode('=', $query_string);
        $query_string = $query_string[1];
        $query_string = explode('/', $query_string);
        return (is_numeric(end($query_string))?end($query_string):"");
    }
    
    public function fetchDataByStatus($status = 0, $currentPage = 0) {
        
        $userController = new UserController();
        $user_id = $userController->getLoggedId();
        if($status == 0) {                    
            $con = Propel::getReadConnection('referral_system');
            $sql = 'SELECT COUNT(client.id) from `client`
                    LEFT JOIN review
                    ON client.id = review.client_id
                    WHERE review.client_id IS NULL';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $total = $stmt->fetchColumn(0);
            
            $limit = 5;
            $offset = $limit * ($currentPage-1);
            $sql = 'SELECT client.* from `client`
                    LEFT JOIN review
                    ON client.id = review.client_id
                    WHERE review.client_id IS NULL
                    ORDER BY id ASC
                    LIMIT '.$limit.'
                    OFFSET '.$offset;

            $stmt = $con->prepare($sql);
            $stmt->execute();
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $reviews = ReviewQuery::create()
                    ->filterByUserId($user_id)
                    ->filterByStatus($status)
                    ->leftJoinWithClient()
                    ->find();            
            $reviews = $reviews->toArray();
            
            $con = Propel::getReadConnection('referral_system');
            $sql = 'SELECT COUNT(client.id) from `client`
                    INNER JOIN review
                    ON client.id = review.client_id
                    WHERE review.status = '.$status;
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $total = $stmt->fetchColumn(0);

            $limit = 5;
            $offset = $limit * ($currentPage-1);
            $sql = 'SELECT client.* from `client`
                    INNER JOIN review
                    ON client.id = review.client_id
                    WHERE review.status = '.$status.'
                    ORDER BY id ASC
                    LIMIT '.$limit.'
                    OFFSET '.$offset;

            $stmt = $con->prepare($sql);
            $stmt->execute();
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }
        
        foreach($reviews as $index => $review) {
            if(isset($reviews[$index]["address"])) {
                $reviews[$index]["address"] = json_decode($review["address"]);   
            }
        }   
        return array('items' => $reviews, 'total' => $total);
    }
}