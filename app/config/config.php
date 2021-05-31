<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('APP_PATH', realpath(dirname(__FILE__)).DS.'..');
define('VIEW_PATH', APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH', APP_PATH . DS . 'template' . DS);
define('CSS', '/css/');
define('JS', '/js/');
define('IMG', '/img/');

//database configaration
defined('DATABASE_HOST_NAME')  ? null : define('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')  ? null : define('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')   ? null : define('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')     ? null : define('DATABASE_DB_NAME', 'location');
defined('DATABASE_PORT_NUMBER')  ? null : define('DATABASE_PORT_NUMBER', '3308');
defined('DATABASE_CONN_DRIVER')  ? null : define('DATABASE_ONN_DRIVER', 1);


defined('UPLOAD_STORAGE') ? null : define('UPLOAD_STORAGE', APP_PATH. DS .'..'.DS.'uploads' );
defined('IMAGES_UPLOAD_STORAGE') ? null : define('IMAGES_UPLOAD_STORAGE', UPLOAD_STORAGE.DS.'images' );
defined('DOCUMENTS_UPLOAD_STORAGE') ? null : define('DOCUMENTS_UPLOAD_STORAGE', UPLOAD_STORAGE.DS.'documents' );