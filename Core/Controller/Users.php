<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\Transaction;
use Core\Model\User;

/**
 * manage the users 
 */
class Users extends Controller
{
    use Tests;
    /**
     * control the view the HTML template
     *
     * @return void
     */
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    public function __construct()
    {
        $this->auth();
    }
    /**
     * list all the user
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['users:read']);  //check if the user has users:read permission
        $this->view = 'users.index'; //view the HTML template
        $user = new User;
        $this->data['users'] = $user->get_all();  // get the data from DB related to users
        $this->data['users_count'] = count($user->get_all()); //count all rows in the users table
    }

    /**
     * display a signle user data
     *
     * @return void
     */
    public function single()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists"); //check if the inserted id is exist in GET request

        $this->permissions(['users:read']); //check if the user has users:read permission
        $this->view = 'users.single'; //view the HTML template
        $user = new User();
        $this->data['user'] = $user->get_by_id($_GET['id']); // get the user data by giving id in the GET request

    }

    /**
     * Display the HTML form for user creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['users:create']);   //check if the user has users:create permission
        $this->view = 'users.create'; //view the HTML template
    }

    /**
     * Creates new user
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['users:create']); //check if the user has users:create permission
        $user = new User();

        self::check_if_empty($_POST['display_name'] && $_POST['username'] && $_POST['email'] && $_POST['role'] && $_POST['password']); //check if data is not empty in POST request

        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT); // hash the password to prevent easy-to-read password

        $permissions = null;
        /**
         * sets the permissions for the created user
         */
        switch ($_POST['role']) {
            case 'admin':
                $permissions = User::ADMIN;
                break;
            case 'procurement':
                $permissions = User::PROCUREMENT;
                break;
            case 'accountant':
                $permissions = User::ACCOUNTANT;
                break;
            case 'seller':
                $permissions = User::SELLER;
                break;
        }

        $_POST['permissions'] = \serialize($permissions); //Generates a storable representation of a value

        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['display_name'] = \htmlspecialchars($_POST['display_name']);
        $_POST['username'] = \htmlspecialchars($_POST['username']);
        $_POST['email'] = \htmlspecialchars($_POST['email']);
        $_POST['role'] = \htmlspecialchars($_POST['role']);

        $user->create($_POST); // create the data in POST request in DB
        Helper::redirect('/users');
    }

    /**
     * Display the HTML form for users update
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['users:update']); //check if the user has users:update permission
        $this->view = 'users.edit'; //view the HTML template
        $user = new User();
        $selected_user = $user->get_by_id($_GET['id']); // get the user info by id in the GET request to view it in HTML form
        $this->data['user'] = $selected_user; //assign the returned info
    }

    /**
     * Updates the post
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['users:update']); //check if the user has users:update permission
        $user = new User();

        self::check_if_empty($_POST['display_name'] && $_POST['username'] && $_POST['email'] && $_POST['role'] && $_POST['password']); //check if data is not empty in POST request

        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);  // hash the password to prevent easy-to-read password

        $permissions = null;
        /**
         * set the permissions for the updated user
         */
        switch ($_POST['role']) {
            case 'admin':
                $permissions = User::ADMIN;
                break;
            case 'procurement':
                $permissions = User::PROCUREMENT;
                break;
            case 'accountant':
                $permissions = User::ACCOUNTANT;
                break;
            case 'seller':
                $permissions = User::SELLER;
                break;
        }

        $_POST['permissions'] = \serialize($permissions); //Generates a storable representation of a value


        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['display_name'] = \htmlspecialchars($_POST['display_name']);
        $_POST['username'] = \htmlspecialchars($_POST['username']);
        $_POST['email'] = \htmlspecialchars($_POST['email']);
        $_POST['role'] = \htmlspecialchars($_POST['role']);

        $user->update($_POST);  // create the data in POST request in DB
        Helper::redirect('/user?id=' . $_POST['id']);
    }

    /**
     * Delete an user
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['users:delete']); //check if the user has users:delete permission
        $user = new User();
        $user->delete($_GET['id']); // delete the data in DB by id in GET request
        Helper::redirect('/users');
    }

    /**
     * view the profile page (HTML) for the current logged in user
     *
     * @return void
     */
    public function profile()
    {
        if (!isset($_GET['id'])) { //redirect the user to the logged in profile single page only
            Helper::redirect('/profile?id=' . $_SESSION['user']['id']);
        }

        $this->view = 'users.profile';
        $user = new User;
        $this->data['user'] = $user->get_by_id($_SESSION['user']['id']);  //get the user data by logged in user id
    }

    /**
     * display the profile info page (HTML) for the current logged in user 
     *
     * @return void
     */
    public function edit_profile()
    {
        if (!isset($_GET['id'])) { //redirect the user to the logged in profile edit form page only
            Helper::redirect('/profile/edit?id=' . $_SESSION['user']['id']);
        }

        $this->view = 'users.edit_profile';
        $user = new User();
        $selected_user = $user->get_by_id($_SESSION['user']['id']); //get the user data by logged in user id
        $this->data['user'] = $selected_user;
    }
    /**
     * update the profile info for the loggedin user
     *
     * @return void
     */
    public function store_profile()
    {
        $user = new User();
        self::check_if_empty($_POST['display_name'] && $_POST['username'] && $_POST['email']); //check if data is not empty in POST request (Form validation)

        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['display_name'] = \htmlspecialchars($_POST['display_name']);
        $_POST['username'] = \htmlspecialchars($_POST['username']);
        $_POST['email'] = \htmlspecialchars($_POST['email']);


        $user->update($_POST); // update the info
        Helper::redirect('/profile?id=' . $_SESSION['user']['id']); ////redirect the user to the logged in profile single page only
    }
}
