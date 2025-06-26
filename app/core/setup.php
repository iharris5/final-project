<?php

//require our files, remember should be relative to index.php
require '../app/core/Router.php';
require '../app/models/Model.php';
require '../app/models/ShoeImage.php';
require '../app/controllers/Controller.php';
require '../app/controllers/MainController.php';
require '../app/controllers/UserController.php';
require '../app/models/User.php';
require '../app/models/Request.php';
require '../app/controllers/RequestController.php';


//set up env variables

if($_SERVER['SERVER_NAME'] == 'localhost') {
    $env = parse_ini_file('../.env');
    /** database config **/
    define('DBNAME', $env['DBNAME']);
    define('DBHOST', $env['DBHOST']);
    define('DBUSER', $env['DBUSER']);
    define('DBPASS', $env['DBPASS']);
    define('DBPORT', $env['DBPORT']);

} else {
    /** database config **/
    define('DBNAME', getenv('DBNAME'));
    define('DBHOST', getenv('DBHOST'));
    define('DBUSER', getenv('DBUSER'));
    define('DBPASS', getenv('DBPASS'));
    define('DBPORT', getenv('DBPORT'));
    define('ROOT', 'https://immense-beyond-39727.herokuapp.com/');
}
