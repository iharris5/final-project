<?php

namespace app\models;

use app\models\Model; 

class Request extends Model { 

    public function createRequest($data) {
        $stmt = $this->db->prepare("INSERT INTO requests (email, design, shoe_size, name, lives_in_US, mailing_address, form_of_contact, insta_handle, payment_method) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $data['email'],
            $data['design'],
            $data['shoe_size'],
	    $data['name'],
	    $data['lives_in_US'],
	    $data['mailing_address'],
	    $data['form_of_contact'],
            $data['insta_handle'],
            $data['payment_method']
        ]);

        if ($stmt->rowCount() > 0) {
            return $this->db->lastInsertId();  
        }

        return false;  
    }

    public function getAllRequests() {
        $stmt = $this->db->query("SELECT * FROM requests");
        return $stmt->fetchAll();
    }

    public function getRequestById($id) {
        $stmt = $this->db->prepare("SELECT * FROM requests WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateRequest($id, $data) {
        $stmt = $this->db->prepare("UPDATE requests SET email = ?, design = ?, shoe_size = ?, name = ?, lives_in_US = ?, mailing_address = ?, form_of_contact = ?, insta_handle = ?, payment_method = ? WHERE id = ?");
        $stmt->execute([
            $data['email'],
            $data['design'],
            $data['shoe_size'],
	    $data['name'],
	    $data['lives_in_US'],
	    $data['mailing_address'],
	    $data['form_of_contact'],
            $data['insta_handle'],
            $data['payment_method'],
            $id
        ]);
    }

    public function deleteRequest($id) {
        $stmt = $this->db->prepare("DELETE FROM requests WHERE id = ?");
        $stmt->execute([$id]);
    }
}

