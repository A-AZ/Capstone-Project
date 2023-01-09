<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\Item;
use Core\Model\Transaction;

class Transactions extends Controller
{
    use Tests;

    /**
     * view the HTML template
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
     * list all the transactions
     *
     * @return void
     */
    public function index()
    {

        $this->permissions(['transactions:read']); //check if the user has transactions:read permission
        $this->view = 'transactions.index';
        $transaction = new Transaction;
        $this->data['transactions'] = $transaction->get_all(); // get the transaction rows and assign it
        $this->data['transactions_count'] = count($transaction->get_all()); // count all the rows 
    }

    /**
     * list a single transaction data
     *
     * @return void
     */
    public function single()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists"); //check if the inserted id is exist in GET request

        $this->permissions(['transactions:read']);  //check if the user has transactions:read permission
        $this->view = 'transactions.single'; //view the HTML template
        $transaction = new Transaction();
        $this->data['transaction'] = $transaction->get_by_id($_GET['id']); // get the trasnaction data by giving id in the GET request
    }

    /**
     * Display the HTML form for Transaction update
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['transactions:update']);  //check if the user has transactions:update permission
        $this->view = 'transactions.edit'; //view the HTML template
        $transaction = new Transaction();
        $selected_transaction = $transaction->get_by_id($_GET['id']); // get the transaction info by id in the GET request to view it in HTML form
        $this->data['transaction'] = $selected_transaction; //assign the returned info
 
        $item = new Item;
        $this->data['items'] = $item->get_all(); // get the items rows in DB to view it in select menue
    }

    /**
     * Updates a transaction
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['transactions:update']);  //check if the user has transactions:update permission
        $transaction = new Transaction();

        self::check_if_empty($_POST['user_id'] && $_POST['id'] && $_POST['items_name'] && $_POST['selling_price'] && $_POST['quantity'] && $_POST['total_sales']); //check if data is complete

        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['user_id'] = \htmlspecialchars($_POST['user_id']);
        $_POST['id'] = \htmlspecialchars($_POST['id']);
        $_POST['items_name'] = \htmlspecialchars($_POST['items_name']);
        $_POST['selling_price'] = \htmlspecialchars($_POST['selling_price']);
        $_POST['quantity'] = \htmlspecialchars($_POST['quantity']);
        $_POST['total_sales'] = \htmlspecialchars($_POST['total_sales']);

        $transaction->update($_POST); // update the data in POST request in DB
        Helper::redirect('/transaction?id=' . $_POST['id']);
    }

    /**
     * Delete the transactions
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['transactions:delete']); //check if the user has transactions:delete permission
        $transaction = new Transaction();
        $transaction->delete($_GET['id']); // delete the data in DB by id in GET request
        Helper::redirect('transactions');
    }
}
