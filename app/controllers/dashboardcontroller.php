<?php


namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Session;
use PHPMVC\Models\AbstractModel;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\ReservationModel;
use PHPMVC\Models\UserModel;

class DashboardController extends AbstractController
{
    use Helper;

    public function defaultAction()
    {
        Session::Start();
        if ($_SESSION['session_user_role'] != 'admin') {
            $this->redirect('/dashboard/user');
        }
        $this->_view();
    }

    public function userAction()
    {
        $this->_view();
    }

    public function statistiqueAction()
    {
        $this->_data['count_rsv'] = ReservationModel::count();
        $this->_data['count_user'] = UserModel::count();
        $this->_data['count_product'] = (int)ProductModel::count();
        $this->_view();
    }
}