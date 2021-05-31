<?php


namespace PHPMVC\Controllers;


use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\ProductModel;
use PHPMVC\LIB\Session;

class ProductController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function __construct()
    {
        Session::Start();
        if ($_SESSION['session_user_role'] != 'admin') {
            $this->redirect('/index');
        }

    }

    public function defaultAction()
    {
        $this->_data['products'] = ProductModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        if (isset($_POST['submit'])) {
            $product = new ProductModel();
            $product->product_name = $this->filterString($_POST['name']);
            $product->product_description = $this->filterString($_POST['desc']);
            $product->product_category = $this->filterString($_POST['category']);
//            $product->product_img = ($_POST['image']);
            $product->product_price = $this->filterFloat($_POST['price']);
            $product->product_img = $_FILES['image']['name'];
            $product_img_temp = $_FILES['image']['tmp_name'];
            move_uploaded_file($product_img_temp, 'img/' . $product->product_img);
            if ($product->save()) {
                $_SESSION['message'] = 'product, saved successfully';
                $this->redirect('/product');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $prod = ProductModel::getByPk($id);
        if ($prod === false) {
            $this->redirect('/product');
        }
        $first_img = $prod->product_img;
        $this->_data['product'] = $prod;
        $product = $this->_data['product'];
        if (isset($_POST['submit'])) {
//            $product = new ProductModel();
//            $product->product_id = $id;
            $product->product_name = $this->filterString($_POST['name']);
            $product->product_description = $this->filterString($_POST['desc']);
            $product->product_category = $this->filterString($_POST['category']);
//            $product->product_img = $this->filterString($_POST['image']);
            $product->product_price = $this->filterFloat($_POST['price']);
            $product->product_img = $_FILES['image']['name'];
            $img_temp = $_FILES['image']['tmp_name'];
            if ($_FILES['image']['name']) {
                move_uploaded_file($img_temp, 'img/' . $product->product_img);
                $product->update();
                $this->redirect('/product');

            } else {
                $product->product_img = $first_img;
                $product->update();
                $_SESSION['message'] = 'product, edited successfully';
                $this->redirect('/product');
            }

        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $prod = ProductModel::getByPk($id);
        if ($prod === false) {
            $this->redirect('/product');
        }

        if ($prod->delete()) {
            $_SESSION['message'] = 'product, deleted successfully';
            $this->redirect('/product');
        }

    }


}