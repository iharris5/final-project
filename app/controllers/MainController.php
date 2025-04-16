<?php

namespace app\controllers;

//this is an example controller class, feel free to delete
require_once(__DIR__ . '/../models/ShoeImage.php');
use app\models\ShoeImage;

class MainController extends Controller {

    public function homepage() {
        //remember to route relative to index.php
	//require page and exit to return an HTML page
	$model = new ShoeImage();
	$images = $model->findAll();

	 if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
            header('Content-Type: application/json');
            echo json_encode($images);
            exit;
	 }

	$this->returnView('./assets/views/main/homepage.html');
    }

    public function getImages() {
    $model = new ShoeImage();
    $images = $model->findAll(); 

    header('Content-Type: application/json');

    echo json_encode($images);
    exit; 
}

    public function notFound() {
    }

}
