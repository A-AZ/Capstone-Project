<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Transaction;
use Core\Helpers\Tests;
use DateTime;
use Exception;
use LDAP\Result;

class SellAPI extends Controller
{
    use Tests;

    protected $request_body;
    protected $http_code = 200;

    protected $response_schema = array(
        "success" => true, // to provide the response status.
        "message_code" => "", // to provide message code for the front-end developer for a better error handling
        "body" => array()
    );

    function __construct()
    {
        $this->request_body = (array) json_decode(file_get_contents("php://input"));
    }

    public function render()
    {
        header("Content-Type: application/json");
        http_response_code($this->http_code);
        echo json_encode($this->response_schema);
    }

    /**
     * view all the transactions that has been made by the logged in user today only
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['transactions:create']);
        $transaction = array();
        try {
            $transaction = new Transaction;

            $date = new \DateTime('Asia/Amman'); // get the current date from DateTime class, timezone is set to be in Amman because default timezone set to be in Germany
            $today = $date->format('Y-m-d'); // format the date as 2023-01-03 and assign it

            $user_id = $_SESSION['user']['id']; // assign the current logged in user id to use in the sql statement

            // prepare the query statemnt, get all transactions rows when transaction id matches on both tables, user_id = logged in user and the date of created transaction = today date
            $sql = "SELECT transactions. * FROM transactions INNER JOIN transactions_users ON transactions.id = transactions_users.transaction_id 
            WHERE DATE(transactions.created_at) ='$today' AND transactions_users.user_id ='$user_id'";
            $result = $transaction->connection->query($sql); //

            $transaction = array();

            if ($result->num_rows > 0) { //check if the there's result in the query, if true fetch data, else throw exception and http 404 code
                while ($row = $result->fetch_object()) {
                    $transaction[] = $row;
                }
            }

            if (empty($transaction)) {
                throw new \Exception('No transaction were found!');
            }

            $this->response_schema['body'] = $transaction;
            $this->response_schema['message_code'] = "transaction_collected_successfuly";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 404;
        }
    }

    /**
     * create transaction, update the quantity of the item and create a relation between user_is and transaction_id 
     *
     * @return void
     */
    public function sell_create()
    {
        $this->permissions(['transactions:create']); //check if the user has transactions:create permission
        self::check_if_empty($this->request_body); //check if data is complete
        self::check_if_exists(isset($this->request_body['item_id'] ) && isset($this->request_body['selling_price']) && isset($this->request_body['quantity']) && isset($_SESSION['user']['id']), "Please make sure all inputs are complete!"); // check that item_id, quanitity and user_id are all complete
        try {

            $transaction = new Transaction;

            $transaction->create($this->request_body); // create the transaction

            $transaction_id = $transaction->get_by_id($transaction->connection->insert_id); //get the created transaction id to view it to the front-end

            $item_id = $this->request_body['item_id']; // assign item_id from the creaated transacation
            $quantity = $this->request_body['quantity']; // assign the quantity of the created transaction to update the item quantity in DB

            $transaction->connection->query("UPDATE items SET quantity = quantity - $quantity WHERE id=$item_id"); // excute the sql query and update the the quantity in the items table in DB

            $user_id = $_SESSION['user']['id']; // assign the logged in user_id from the $_session global variable 
            $transaction->connection->query("INSERT INTO transactions_users (transaction_id, user_id) VALUES ($transaction_id->id, $user_id)"); //excute the sql statment 

            
            $this->response_schema['message_code'] = "transaction_created_successfuly";
            $this->response_schema['body'][] = $transaction_id; //view the created transaction id in the body
        } catch (\Exception $error) {
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 422;
        }
    }

    /**
     * updates the transaction, update the quantity in items table
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['transactions:create']); //check if the user has transactions:create permission
        self::check_if_empty($this->request_body); //check if data is not empty
        self::check_if_exists(isset($this->request_body['quantity']) && isset($this->request_body['id']), "Please make sure all arguments are included!"); // check that item_id, quanitity and user_id are all complete
        try {
            $transaction = new Transaction;

            $selected_transaction = $transaction->get_by_id($this->request_body['id']); // get the transaction data
            $original_quantity = $selected_transaction->quantity; //assign the original quantity value before the edit (before the uppdate)

            $transaction->update($this->request_body); // update the transaction body

            $new_quantity = $this->request_body['quantity']; //assign the edited quantity (after the update)
            $quantity_difference = $new_quantity - $original_quantity; //calculate the difference between the orginal quantity and new quantity
            $item_id = $this->request_body['item_id']; // get item_id from the transacation
            $transaction->connection->query("UPDATE `items` SET quantity = quantity - $quantity_difference WHERE id=$item_id"); // excute the sql query and update the the quantity in the items table in DB

            $this->response_schema['message_code'] = "transaction_updated_successfuly";
            $this->response_schema['body'][] = $this->request_body; //view the edited transaction id in the body
        } catch (\Exception $error) {
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 421;
        }
    }

    /**
     * delete the transaction, update the the quantity of item in items table and delete the relation in transactions_users table
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['transactions:create']); //check if the user has transactions:create permission
        self::check_if_empty($this->request_body); //check if data is not empty
        self::check_if_exists(isset($this->request_body['item_id']) && isset($this->request_body['quantity']) && isset($this->request_body['id']) && isset($_SESSION['user']['id']), "Please make sure all inputs are complete!"); // check that item_id, quanitity and user_id are all complete
        try {


            $transaction = new Transaction();
            $id = $this->request_body['id']; // assign the deleted transaction_id
            $item_id = $this->request_body['item_id']; // assign the item_id from the deleted transacation 
            $quantity = $this->request_body['quantity']; // assign the quantity of the deleted transaction

            $transaction->delete($this->request_body['id']); // delete the transaction body

            $transaction->connection->query("UPDATE items SET quantity = quantity + $quantity WHERE id=$item_id"); // excute the sql query to update the the quantity in the items table in DB
            $transaction->connection->query("DELETE FROM transactions_users WHERE transaction_id=$id"); // excute the sql query to delete the transaactions_users relation table

            $this->response_schema['message_code'] = "transaction_deleted_succecfully";
            $this->response_schema['body'][] = $this->request_body;
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 421;
        }
    }
}
