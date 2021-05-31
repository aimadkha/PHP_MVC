<?php


namespace PHPMVC\Controllers;


use PHPMVC\LIB\FrontController;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;

    protected $_data = array();
    public function NotFoundAction()
    {
        $this->_view();
    }

    public function setController ($controllerName){
        $this->_controller = $controllerName;
    }

    public function setAction ($actionName){
        $this->_action = $actionName;
    }

    public function setParams ($paramsName){
        $this->_params = $paramsName;
    }

    protected function _view(){
        if ($this->_action == FrontController::NOT_FOUND_ACTION){
            require_once (VIEW_PATH.'notfound'.DS. 'notfound.view.php');
        } else {
            $view = VIEW_PATH.$this->_controller.DS.$this->_action. '.view.php';
            if (file_exists($view)){
                extract($this->_data);
                require_once TEMPLATE_PATH.'templateheaderstart.php';
                require_once TEMPLATE_PATH.'templateheaderend.php';
                require_once TEMPLATE_PATH.'header.php';
                require_once $view;
                require_once TEMPLATE_PATH.'templatefooter.php';
            }
            else {
                require_once (VIEW_PATH.'notfound'.DS. 'noview.view.php');
            }
        }

    }
}