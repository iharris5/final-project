<?php

namespace app\controllers;

use app\models\Request;

class RequestController extends Controller {

    // Create a new request
    public function createRequest() {
        $data = json_decode(file_get_contents("php://input"), true);

        $errors = [];

        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email.";
        }

        // Validate required fields
        if (empty($data['design']) || empty($data['name']) || empty($data['shoe_size']) || empty($data['payment_method'])) {
            $errors[] = "Missing required fields.";
        }

        if (!empty($errors)) {
            http_response_code(400);
            $this->returnJSON(['errors' => $errors]);
            return;
        }

        // Sanitize inputs
        $data['email'] = htmlspecialchars($data['email']);
        $data['design'] = htmlspecialchars($data['design']);
        $data['shoe_size'] = htmlspecialchars($data['shoe_size']);
	$data['name'] = htmlspecialchars($data['name']);
	$data['lives_in_US'] = isset($data['lives_in_US']) ? htmlspecialchars($data['lives_in_US']) : 'No';
	$data['form_of_contact'] = isset($data['form_of_contact']) ? htmlspecialchars($data['form_of_contact']) : 'Instagram';
        $data['mailing_address'] = htmlspecialchars($data['mailing_address']);
        $data['insta_handle'] = htmlspecialchars($data['insta_handle']);

        // Create the request in the database
        $requestModel = new Request();
        $insertId = $requestModel->createRequest($data);  // We now expect the ID here.

        if ($insertId) {
            $this->returnJSON(['success' => true, 'id' => $insertId]);  // Return the inserted ID
        } else {
            http_response_code(500);
            $this->returnJSON(['error' => 'Failed to create request.']);
        }
    }

    // Get all requests
    public function getAllRequests() {
        $requestModel = new Request();
        $requests = $requestModel->getAllRequests();
        $this->returnJSON($requests);
    }

    // Get a specific request by ID
    public function getRequestById($id) {
        $requestModel = new Request();
        $request = $requestModel->getRequestById($id);
        $this->returnJSON($request);
    }

    // Update a request
    public function updateRequest($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $requestModel = new Request();
        $requestModel->updateRequest($id, $data);
        $this->returnJSON(['message' => 'Request updated successfully.']);
    }

    // Delete a request
    public function deleteRequest($id) {
        $requestModel = new Request();
        $requestModel->deleteRequest($id);
        $this->returnJSON(['message' => 'Request deleted successfully.']);
    }

    // Show the request form
    public function showRequestForm() {
        $this->returnView('./assets/views/users/userRequest.html');
    }

    // Show the review page for a request
    public function showReviewPage($id) {
        $requestModel = new Request();
        $requestData = $requestModel->getRequestById($id);

        if (!$requestData) {
            http_response_code(404);
            echo "Request not found.";
            exit;
        }

        require './assets/views/users/reviewRequest.php';
    }

    public function showThankYouPage() {
    	$this->returnView('./assets/views/users/thank-you.php');
    }    
}

