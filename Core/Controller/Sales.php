<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Model\Transaction;
use Core\Model\Item;

class Sales extends Controller
{
    /**
     * display the HTML 
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


    public function index()
    {
        $this->permissions(['transactions:create']); //check if the user has transactions:create permission
        $this->view = 'sales.index'; // view the HTML template
        $item = new Item;
        $this->data['items'] = $item->get_all(); // get the items rows in DB to view it in select menue
    }
}
