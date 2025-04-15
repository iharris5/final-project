<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\RequestController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleMainRoutes();
	$this->handleUserRoutes();
	$this->handleRequestRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }
    }

    protected function handleUserRoutes() {
        if ($this->uriArray[1] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->usersView();
        }

        //give json/API requests a api prefix
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->getUsers();
        }
    }
    
    protected function handleRequestRoutes() {
        // Route to get all requests (API)
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'requests' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $requestController = new RequestController();
            $requestController->getAllRequests();
        }

        // Route to create a new request (API)
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'requests' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestController = new RequestController();
            $requestController->createRequest();
        }

        // Route to get a request by ID (API)
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'requests' && isset($this->uriArray[3]) && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $requestController = new RequestController();
            $requestController->getRequestById($this->uriArray[3]);
        }

        // Route to update a request (API)
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'requests' && isset($this->uriArray[3]) && $_SERVER['REQUEST_METHOD'] === 'PUT') {
            $requestController = new RequestController();
            $requestController->updateRequest($this->uriArray[3]);
        }

        // Route to delete a request (API)
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'requests' && isset($this->uriArray[3]) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $requestController = new RequestController();
            $requestController->deleteRequest($this->uriArray[3]);
	}
	if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'request' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    	    $requestController = new RequestController();
    	    $requestController->showRequestForm(); // Create this method in your controller
	}
	
	if ($this->uriArray[1] === 'requests' && isset($this->uriArray[2]) && $this->uriArray[3] === 'review' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $requestController = new RequestController();
            $requestController->showReviewPage($this->uriArray[2]);
	}

	if ($this->uriArray[1] === 'requests' && isset($this->uriArray[2]) && isset($this->uriArray[3]) && $this->uriArray[3] === 'edit' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    	    $requestController = new RequestController();
            $requestController->showEditForm($this->uriArray[2]);
	}

	if ($this->uriArray[1] === 'review' && isset($this->uriArray[2]) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    	    $requestController = new RequestController();
            $requestController->showReviewPage($this->uriArray[2]);
	}

	if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'review' && isset($this->uriArray[2]) && $_SERVER['REQUEST_METHOD'] === 'GET') {
        	include_once __DIR__ . '/../views/reviewRequest.html';
        	exit;
    	}
	
	if ($this->uriArray[1] === 'thank-you') {
    		$requestController = new RequestController();
    		$requestController->showThankYouPage();
	}
    }
}
