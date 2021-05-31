<?php


namespace PHPMVC\Controllers;


use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Session;
use PHPMVC\Models\UserModel;

class UserController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function __construct()
    {
        Session::Start();

    }

    public function defaultAction()
    {
        if ($_SESSION['session_user_role'] != 'admin') {
            $this->redirect('/index');

        }
        $this->_data['users'] = UserModel::getAll();
        $this->_view();
    }

    public function registerAction()
    {
        if (isset($_POST['submit'])) {
            $user = new UserModel();
            $user->user_name = $this->filterString($_POST['name']);
            $user->user_email = $this->filterString($_POST['email']);
            $user->user_pass = $this->filterString($_POST['password']);
            $user->user_address = $this->filterString($_POST['address']);
            $user->user_first_name = $this->filterString($_POST['first_name']);
            $user->user_last_name = $this->filterString($_POST['last_name']);
//            var_dump($user);
            if ($user->save()) {
                $_SESSION['message'] = 'user, added successfully';
                $this->redirect('/index');
            }
        }

        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
//        var_dump($id);
        $user = UserModel::getByPk($id);
        if ($user === false) {
            $this->redirect('/user');
        }
//        var_dump($user);
        $this->_data['user'] = $user;
        if (isset($_POST['submit'])) {
//            $user = new UserModel();
            $user->user_name = $this->filterString($_POST['name']);
            $user->user_email = $this->filterString($_POST['email']);
            $user->user_pass = $this->filterString($_POST['password']);
            $user->user_address = $this->filterString($_POST['address']);
            $user->user_first_name = $this->filterString($_POST['first_name']);
            $user->user_last_name = $this->filterString($_POST['last_name']);
//            var_dump($user);
            if ($user->save()) {
                $_SESSION['message'] = 'user, added successfully';
                $this->redirect('/user');
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        var_dump($id);
        $user = UserModel::getByPk($id);
        if ($user->delete()) {
            $_SESSION['message'] = 'user, deleted successfully';
            $this->redirect('/user');
        }
    }

    public function loginAction()
    {
        if (isset($_POST['login'])) {
            $login_user = trim($_POST['name']);
            $login_pass = trim($_POST['password']);


            if (UserModel::checkAuth($login_user, $login_pass)) {
                $this->_data['profile'] = $_SESSION;
                $profile = $this->_data['profile'];
//                $user_id = $_SESSION['session_id'];
//                var_dump($user_id);
                Session::Set('user', $login_user);
//                Session::Set('id', $user_id);
//                var_dump($profile);
                if ($_SESSION['session_user_role'] == 'admin'){
//                    $this->redirect('/dashboard');
                }
                elseif ($_SESSION['session_user_role'] == 'user'){
                    $this->redirect('/dashboard/user');
                }

            } else {
                $_SESSION['msg'] = "Incorrect information try again!!";

            }
        }

        $this->_view();
    }

    public function logoutAction()
    {
        Session::Stop();
        $this->redirect('/index');

    }
}