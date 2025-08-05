<?php

namespace app\models;

abstract class Model {

    protected $db;

    public function __construct() {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->db = new \PDO($string, DBUSER, DBPASS);
    }

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    public function query($query, $data = []) {
        $stm = $this->db->prepare($query);
        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}

