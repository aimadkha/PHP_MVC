<?php

namespace PHPMVC;


use PHPMVC\LIB\FrontController;

if (!defined('DS')) {

    define('DS', DIRECTORY_SEPARATOR);

}

require_once '..' . DS . 'app' . DS .'config'.DS. 'config.php';
require_once APP_PATH.DS.'lib'.DS.'autoload.php';
$template_parts = require_once '..' . DS . 'app' . DS .'config'.DS. 'templateconfig.php';

require_once APP_PATH . DS . 'lib' . DS . 'database' . DS . 'databasehandler.php';


$frontcontroller = new FrontController();
$frontcontroller->dispatch();


