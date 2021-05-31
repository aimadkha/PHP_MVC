<?php

namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Session;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\ReservationModel;
use PHPMVC\Models\UserModel;

class IndexController extends AbstractController
{
    use Helper;
    use InputFilter;
    public function defaultAction()
    {
        Session::Start();
        $this->_data['products'] = ProductModel::getAll();
//        $products = $this->_data['products'];
//        var_dump($products);
        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }

    public function reserveAction()
    {
        Session::Start();
        $user_id = $_SESSION['session_id'];
        $this->_data['user'] = UserModel::getByPK($user_id);
        $id = $this->filterInt($this->_params[0]);
        $item_reserved = ProductModel::getByPk($id);
        $this->_data['item'] = $item_reserved;
        $item = $this->_data['item'];
        if ($item_reserved === false) {
            $this->redirect('/product');
        }

        if (isset($_POST['confirm'])){
            $reservation = new ReservationModel();
            $reservation->user_id = $user_id;
            $reservation->product_id = $id;
            $reservation->duration = $this->filterInt($_POST['duration']);

            if ($reservation->save()){
                $_SESSION['message'] = 'reservation added successfully';
                $this->redirect('index');
            }
        }
        $this->_view();
    }
}