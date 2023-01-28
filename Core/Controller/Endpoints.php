<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Endpoint;
use Core\Model\Transaction;
use Core\Helpers\Tests;
use DateTime;
use Exception;
use LDAP\Result;

class Endpoints extends Controller
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
        try {
            $endpoint = new Endpoint;

            $date = new \DateTime('Asia/Amman'); // get the current date from DateTime class, timezone is set to be in Amman because default timezone set to be in Germany
            $today = $date->format('Y-m-d'); // format the date as 2023-01-03 and assign it
            $user_id = $_SESSION['user']['id']; // assign the current logged in user id to use in the sql statement

            $transaction = $endpoint->my_today_transactions($today, $user_id);

            if (empty($transaction)) {
                throw new \Exception('No transactions were found for the current user today!');
            }

            $this->response_schema['body'] = $transaction;
            $this->response_schema['message_code'] = "transactions_collected_successfuly";
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
        try {
            if (!isset($this->request_body['item_id']) || !is_numeric($this->request_body['item_id']) || empty($this->request_body['item_id'])) {
                throw new \Exception("Please provide a valid item id.", 422);
            }
            if (!isset($this->request_body['selling_price']) || !is_numeric($this->request_body['selling_price']) || empty($this->request_body['selling_price'])) {
                throw new \Exception("Please provide a valid selling price.", 422);
            }
            if (!isset($this->request_body['quantity']) || !is_numeric($this->request_body['quantity']) || empty($this->request_body['quantity'])) {
                throw new \Exception("Please provide a valid quantity.", 422);
            }
            if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
                throw new \Exception("Invalid user id.", 422);
            }

            $transaction = new Transaction;
            $transaction->create($this->request_body); // create the transaction

            $transaction_id = $transaction->get_by_id($transaction->connection->insert_id); //get the created transaction id to view it to the front-end
            $item_id = $this->request_body['item_id']; // assign item_id from the creaated transacation
            $quantity = $this->request_body['quantity']; // assign the quantity of the created transaction to update the item quantity in DB

            $endpoint = new Endpoint;
            $endpoint->update_quantity($quantity, $item_id);
            $endpoint->transaction_user_rel($transaction_id->id, $_SESSION['user']['id']);

            $this->response_schema['message_code'] = "transaction_created_successfuly";
            $this->response_schema['body'][] = $transaction_id; //view the created transaction id in the body
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = $error->getCode();
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
        try {
            if (!isset($this->request_body['id']) || !is_numeric($this->request_body['id']) || empty($this->request_body['id'])) {
                throw new \Exception("Please provide a valid item id.", 422);
            }
            if (!isset($this->request_body['item_id']) || !is_numeric($this->request_body['item_id']) || empty($this->request_body['item_id'])) {
                throw new \Exception("Please provide a valid item id.", 422);
            }
            if (!isset($this->request_body['selling_price']) || !is_numeric($this->request_body['selling_price']) || empty($this->request_body['selling_price'])) {
                throw new \Exception("Please provide a valid selling price.", 422);
            }
            if (!isset($this->request_body['quantity']) || !is_numeric($this->request_body['quantity']) || empty($this->request_body['quantity'])) {
                throw new \Exception("Please provide a valid quantity.", 422);
            }
            if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
                throw new \Exception("Invalid user id.", 422);
            }

            $transaction = new Transaction;
            $selected_transaction = $transaction->get_by_id($this->request_body['id']); // get the transaction data
            $original_quantity = $selected_transaction->quantity; //assign the original quantity value before the edit (before the uppdate)
            $transaction->update($this->request_body); // update the transaction body

            $new_quantity = $this->request_body['quantity']; //assign the edited quantity (after the update)
            $quantity_difference = $new_quantity - $original_quantity; //calculate the difference between the orginal quantity and new quantity
            $item_id = $this->request_body['item_id']; // get item_id from the transacation

            $endpoint = new Endpoint;
            $endpoint->edit_quantity($quantity_difference, $item_id);

            $this->response_schema['message_code'] = "transaction_updated_successfuly";
            $this->response_schema['body'][] = $this->request_body; //view the edited transaction id in the body
        } catch (\Exception $error) {
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = $error->getCode();
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
        try {
            if (!isset($this->request_body['id']) || !is_numeric($this->request_body['id']) || empty($this->request_body['id'])) {
                throw new \Exception("Please provide a valid item id.", 422);
            }
            if (!isset($this->request_body['item_id']) || !is_numeric($this->request_body['item_id']) || empty($this->request_body['item_id'])) {
                throw new \Exception("Please provide a valid item id.", 422);
            }
            if (!isset($this->request_body['quantity']) || !is_numeric($this->request_body['quantity']) || empty($this->request_body['quantity'])) {
                throw new \Exception("Please provide a valid quantity.", 422);
            }
            if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
                throw new \Exception("Invalid user id.", 422);
            }

            $transaction = new Transaction();
            $id = $this->request_body['id']; // assign the deleted transaction_id
            $item_id = $this->request_body['item_id']; // assign the item_id from the deleted transacation 
            $quantity = $this->request_body['quantity']; // assign the quantity of the deleted transaction

            $transaction->delete($this->request_body['id']); // delete the transaction body

            $endpoint = new Endpoint;
            $endpoint->reset_quantity($quantity, $item_id);
            $endpoint->delete_relation($id);

            $this->response_schema['message_code'] = "transaction_deleted_succecfully";
            $this->response_schema['body'][] = $this->request_body;
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = $error->getCode();
        }
    }
}
