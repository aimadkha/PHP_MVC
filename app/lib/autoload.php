<?php


namespace PHPMVC\LIB;
//define('DS', DIRECTORY_SEPARATOR);

//define('APP_PATH', dirname(realpath(__FILE__)) . DS . '..');


class Autoload
{
    public static function autoload($className){
        $className = str_replace('PHPMVC','/', $className);
        $className = str_replace('\\','/', $className);
        $classFile = APP_PATH  . strtolower($className) . '.php';
        if (file_exists($classFile)){
            require_once $classFile;
        }
    }
}
spl_autoload_register(__NAMESPACE__.'\Autoload::autoload');