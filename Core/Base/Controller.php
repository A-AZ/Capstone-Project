<?php

namespace Core\Base;

use Core\Helpers\Helper;
use Core\Model\User;
use Core\Controller\Authentication;

abstract class Controller
{
    abstract public function render();

    protected $view = null;
    protected $data = array();

    protected function view()
    {
        new View($this->view, $this->data);
    }

    /**
     * backend security layer for login authorization
     *
     * @return void
     */
    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/login');
        }
    }

    /**
     * check if the user has the permissions 
     *
     * @return array $permissions_set
     */
    protected function permissions(array $permissions_set)
    {

        $this->auth();
        $user = new User;
        $assigned_permissions = $user->get_permissions();

        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                switch ($_SESSION['user']['role']) {
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
        }
    }
}
