<?php


namespace PHPMVC\Controllers;


use PHPMVC\LIB\Session;
use PHPMVC\Models\AbstractModel;
use PHPMVC\Models\ReservationModel;

class ReservationController extends AbstractController
{
    public function defaultAction()
    {
        $this->_data['reserved'] = ReservationModel::getAll();
        $reserved = $this->_data['reserved'];
        $this->_view();
    }

    public function reserveuserAction(){
        Session::Start();
        $id = $_SESSION['session_id'];
        $this->_data['reserved'] = ReservationModel::affichereserve($id);
        $reserved =$this->_data['reserved'];
        $this->_view();
    }
}