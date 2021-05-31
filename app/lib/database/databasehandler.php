<?php

namespace PHPMVC\lib\Database;

abstract class DatabaseHandler
{

    private function __construct()
    {
    }

    abstract protected static function init();

    abstract protected static function getInstance();

    public static function factory(): PdoDatabaseHandler
    {
            return PdoDatabaseHandler::getInstance();
    }
}