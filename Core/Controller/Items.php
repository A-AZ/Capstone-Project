<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Helpers\Tests;

class Items extends Controller
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

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->auth();
    }

    /**
     * lists all the items
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['items:read']); //check if the user has items:read permission
        $this->view = 'items.index'; //view the HTML template
        $item = new Item;
        $this->data['items'] = $item->get_all(); // get the data from DB related to items
        $this->data['items_count'] = count($item->get_all()); //count all rows in the items table
    }

    /**
     * view single item data
     *
     * @return void
     */
    public function single()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists"); //check if the inserted id is exist in GET request

        $this->permissions(['items:read']); //check if the user has items:read permission
        $this->view = 'items.single'; //view the HTML template
        $item = new Item();
        $this->data['item'] = $item->get_by_id($_GET['id']); // get the item data by giving id in the GET request
    }

    /**
     * Display the HTML form for item creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['items:create']); //check if the user has items:create permission
        $this->view = 'items.create'; //view the HTML template
    }

    /**
     * Creates new Item
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['items:create']); //check if the user has items:create permission
        $item = new Item();

        self::check_if_empty($_POST['item_name'] && $_POST['selling_price'] && $_POST['cost_price'] && $_POST['quantity']); //check if data is complete in POST request

        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['item_name'] = \htmlspecialchars($_POST['item_name']);
        $_POST['selling_price'] = \htmlspecialchars($_POST['selling_price']);
        $_POST['cost_price'] = \htmlspecialchars($_POST['cost_price']);
        $_POST['quantity'] = \htmlspecialchars($_POST['quantity']);

        $item->create($_POST); // create the data in POST request in DB
        Helper::redirect('/items'); 
    }

    /**
     * Display the HTML form to update an item
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['items:update']); //check if the user has items:update permission
        $this->view = 'items.edit';  //view the HTML template
        $item = new Item();
        $selected_item = $item->get_by_id($_GET['id']); // get the items info by id in the GET request to view it in HTML form
        $this->data['item'] = $selected_item; //assign the returned info
    }

    /**
     * Updates an item
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['items:update']); //check if the user has items:update permission
        $item = new Item();

        self::check_if_empty($_POST['item_name'] && $_POST['selling_price'] && $_POST['cost_price'] && $_POST['quantity']); //check if data is complete in POST request

        //to prevet xss attacks, convert the characters to HTML entities
        $_POST['item_name'] = \htmlspecialchars($_POST['item_name']);
        $_POST['selling_price'] = \htmlspecialchars($_POST['selling_price']);
        $_POST['cost_price'] = \htmlspecialchars($_POST['cost_price']);
        $_POST['quantity'] = \htmlspecialchars($_POST['quantity']);

        $item->update($_POST);  // update the data in POST request in DB
        Helper::redirect('/item?id=' . $_POST['id']);
    }

    /**
     * Delete an item
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['items:delete']); //check if the user has items:delete permission
        $item = new Item();
        $item->delete($_GET['id']);  // delete the data in DB by id in GET request
        Helper::redirect('/items');
    }
}
