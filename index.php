<?php

namespace Core\Controller;

session_start();

use Core\Model\User;
use Core\Router;

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); 
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});

if (isset($_COOKIE['id']) && !isset($_SESSION['user'])) {
    $user = new User();
    $logged_in_user = $user->get_by_id($_COOKIE['id']);

    $_SESSION['user'] = array(
        'username' => $logged_in_user->username,
        'id' => $logged_in_user->id,
        'display_name' => $logged_in_user->display_name,
        'permissions' => $logged_in_user->permissions,
        'role' => $logged_in_user->role,
    );
}

// For login & logout
Router::get('/login', "authentication.login"); //Display login Page (HTML)
Router::get('/logout', "authentication.logout"); //logout the user (PHP)
Router::post('/authenticate', "authentication.validate"); //Validate the login info (PHP)

// Informative Dashboard [Admin]
Router::get('/dashboard', "dashboard.index"); // Informnative dashboard (HTML)

//Inventory routes [Admin & Procurement Only]
Router::get('/items', "items.index"); // list of items (HTML)
Router::get('/item', "items.single"); // Display single item (HTML)
Router::get('/items/create', "items.create"); // Display the creation of item form (HTML)
Router::post('/items/store', "items.store"); // Creates the items (PHP)
Router::get('/items/edit', "items.edit"); // Display the edit of item form (HTML)
Router::post('/items/update', "items.update"); // Updates the item info (PHP)
Router::get('/items/delete', "items.delete"); // Delete the post (PHP)

// Transactions routes [Admin & Accountant Only]
Router::get('/transactions', "transactions.index"); // list of transactions (HTML)
Router::get('/transaction', "transactions.single"); // Displays single transaction (HTML)
Router::get('/transactions/edit', "transactions.edit"); // Display the edit of transaction form (HTML)
Router::post('/transactions/update', "transactions.update"); // Updates the transactions info (PHP)
Router::get('/transactions/delete', "transactions.delete"); // Delete the transaction (PHP)

// Seller dashboard [Admin & Seller Only] 
Router::get('/sales', "sales.index"); // list of transactions - CRUD functions (HTML)

// API/AJAx routes
Router::get('/sales/get', "endpoints.index"); //view tranactions (JSON)
Router::post('/sales/post', "endpoints.sell_create"); //create transaction (PHP)
Router::put('/sales/put', "endpoints.update"); //update transaction (PHP)
Router::delete('/sales/delete', "endpoints.delete"); //delete transaction (PHP)

//Users [Admin Only]
Router::get('/users', "users.index"); // list of users (HTML)
Router::get('/user', "users.single"); // Displays single user (HTML)
Router::get('/users/create', "users.create"); // Display the creation of user form (HTML)
Router::post('/users/store', "users.store"); // Create the user (PHP)
Router::get('/users/edit', "users.edit"); // Display the edit of user form (HTML)
Router::post('/users/update', "users.update"); // Updates the user (PHP)
Router::get('/users/delete', "users.delete"); // Delete the user (PHP)

//Profile Page [for the current logged in user]
Router::get('/profile', "users.profile"); // Displays the logged in profile (HTML)
Router::get('/profile/edit', "users.edit_profile"); // Displays the edit form for profile (HTML)
Router::post('/profile/store', "users.store_profile"); // update the profile (PHP)

Router::redirect();
