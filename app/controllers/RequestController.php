<?php

namespace app\controllers;

use app\models\Request;

class RequestController extends Controller {

    public function createRequest() {
        $data = json_decode(file_get_contents("php://input"), true);

        $errors = [];

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email.";
        }

        if (empty($data['design']) || empty($data['name']) || empty($data['shoe_size']) || empty($data['payment_method'])) {
            $errors[] = "Missing required fields.";
        }

        if (!empty($errors)) {
            http_response_code(400);
            $this->returnJSON(['errors' => $errors]);
            return;
        }

        $data['email'] = htmlspecialchars($data['email']);
        $data['design'] = htmlspecialchars($data['design']);
        $data['shoe_size'] = htmlspecialchars($data['shoe_size']);
	$data['name'] = htmlspecialchars($data['name']);
	$data['lives_in_US'] = isset($data['lives_in_US']) ? htmlspecialchars($data['lives_in_US']) : 'No';
	$data['form_of_contact'] = isset($data['form_of_contact']) ? htmlspecialchars($data['form_of_contact']) : 'Instagram';
        $data['mailing_address'] = htmlspecialchars($data['mailing_address']);
        $data['insta_handle'] = htmlspecialchars($data['insta_handle']);

        $requestModel = new Request();
        $insertId = $requestModel->createRequest($data);  // We now expect the ID here.

        if ($insertId) {
            $this->returnJSON(['success' => true, 'id' => $insertId]);  // Return the inserted ID
        } else {
            http_response_code(500);
            $this->returnJSON(['error' => 'Failed to create request.']);
        }
    }

    public function getAllRequests() {
        $requestModel = new Request();
        $requests = $requestModel->getAllRequests();
        $this->returnJSON($requests);
    }

    public function getRequestById($id) {
        $requestModel = new Request();
        $request = $requestModel->getRequestById($id);
        $this->returnJSON($request);
    }

    public function updateRequest($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $requestModel = new Request();
        $requestModel->updateRequest($id, $data);
        $this->returnJSON(['message' => 'Request updated successfully.']);
    }

    public function deleteRequest($id) {
        $requestModel = new Request();
        $requestModel->deleteRequest($id);
        $this->returnJSON(['message' => 'Request deleted successfully.']);
    }

    public function showRequestForm() {
        $this->returnView('./assets/views/users/userRequest.html');
    }

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

