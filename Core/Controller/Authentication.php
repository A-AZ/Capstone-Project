<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Authentication extends Controller
{

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }
    public function login()
    {
        $this->view = 'login';
    }

    /**
     * validate the logged-in user
     *
     * @return void
     */
    public function validate()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) { // check if the request is POST and empty or not, if request not POST or empty post, it exit the validations
            $this->invalid_redirect();
        }
        $user = new User();
        $logged_in_user = $user->check_username($_POST['username']); //check the username in DB

        if (!$logged_in_user) {
            $this->invalid_redirect();
        };

        if (!\password_verify($_POST['password'], $logged_in_user->password)) { //check if the input password hash matches the password hash in DB
            $this->invalid_redirect();
        };

        $_SESSION['user'] = array(
            'username' => $logged_in_user->username,
            'id' => $logged_in_user->id,
            'display_name' => $logged_in_user->display_name,
            'permissions' => $logged_in_user->permissions,
            'role' => $logged_in_user->role,
        );

        if (isset($_POST['remember_me'])) { // set cookie for the logged in user if remember me is checked
            \setcookie('id', $logged_in_user->id, time() + (86400 * 30)); //86400 sec/day 
        }

        switch ($logged_in_user->role) { // to redirect the user based on the the permissions
            case 'admin':
                Helper::redirect('/dashboard');
                break;
            case 'procurement':
                Helper::redirect('/items');
                break;
            case 'accountant':
                Helper::redirect('/transactions');
                break;
            case 'seller':
                Helper::redirect('/sales');
                break;
        }
    }

    /**
     * distory the session when logging out
     *
     * @return void
     */
    public function logout()
    {
        \session_destroy();
        \session_reset();
        \setcookie('id', '', time() - 3600); // destory the cookie by setting in a past time
        Helper::redirect('/login');
    }

    /**
     * redircet to login page if there's error or unauthorized user
     *
     * @return void
     */
    private function invalid_redirect()
    {
        $_SESSION['error'] = "Invalid Username or Password";
        Helper::redirect('/login');
        exit();
    }
}
