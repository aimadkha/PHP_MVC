<?php

namespace PHPMVC\lib\Database;

class PdoDatabaseHandler extends DatabaseHandler
{
    private static $_instance;
    private static $_handler;

    private function __construct(){
        self::init();
    }

    public function __call($name, $arguments){
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO('mysql:host='. DATABASE_HOST_NAME . ":". DATABASE_PORT_NUMBER.';dbname=' . DATABASE_DB_NAME , DATABASE_USER_NAME, DATABASE_PASSWORD);
        } catch (\PDOException $e) {

        }

    }

    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}