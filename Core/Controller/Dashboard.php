<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Model\User;
use Core\Base\Model;

class Dashboard extends Controller
{
    /**
     * display HTML template
     *
     * @return void
     */
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }
    
    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->auth();
    }

    /**
     * control the content in the dashboard page
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['dashboard:read']); //check if the user has dashboard:read permission
        $this->view = 'dashboard.index'; // view the HTML template

        $item = new Item();
        $this->data['items'] = $item->get_all(); // get the data from DB related to items
        $this->data['items_count'] = count($item->get_all()); //count all rows in the items table
        $this->data['top_expensive'] = $item->top_expensive(); //get the top 5 expensive items in items table

        $transaction = new Transaction;
        $this->data['transactions'] = $transaction->get_all();  // get the data from DB related to transactions
        $this->data['transactions_count'] = count($transaction->get_all()); //count all rows in the transactions table
        $this->data['sum_total_sales'] = $transaction->sum_total_sales(); //get the summation of total sales columne in transactions table

        $user = new User;
        $this->data['users'] = $user->get_all(); // get the data from DB related to users
        $this->data['users_count'] = count($user->get_all()); //count all rows in the users table

    }
}
