<?php

namespace Core\Model;

use Core\Base\Model;

class Endpoint extends Model
{
    /**
     * a function that collect all the transactions that has been made today for the current logged in user
     *
     * @param string $today
     * @param int $user_id
     * @return array
     */
    public function my_today_transactions($today, $user_id): array
    {
        $stmt = $this->connection->prepare("SELECT transactions. * FROM transactions INNER JOIN transactions_users ON transactions.id = transactions_users.transaction_id 
        WHERE DATE(transactions.created_at) = ? AND transactions_users.user_id = ?"); //sql statemnt with empty parameters to prevent SQL injections
        $stmt->bind_param("si", $today, $user_id); //bind the parameters to the statment
        $stmt->execute(); // execute the statment
        $result = $stmt->get_result(); //collect the results
        $stmt->close(); // close the statement

        $transaction = array(); // casting an empty array to save the result in it
        if ($result->num_rows > 0) { //checking if there is rows, if true set it as object, null when empty and fail as failure
            while ($row = $result->fetch_object()) {
                $transaction[] = $row;
            }
        }
        return $transaction;
    }

    /**
     * a function that will update the quantity of item when create a transaction
     *
     * @param int $quantity
     * @param int $item_id
     * @return void
     */
    public function update_quantity($quantity, $item_id)
    {
        $stmt = $this->connection->prepare("UPDATE items SET quantity = quantity - ? WHERE id=?");
        $stmt->bind_param("ii", $quantity, $item_id);
        $stmt->execute();
        $stmt->close(); // close the statement
    }

    /**
     * a function that create a row in seperate table that has a relation with the transaction_id and user_id
     *
     * @param int $transaction_id
     * @param int $user_id
     * @return void
     */
    public function transaction_user_rel($transaction_id, $user_id)
    {
        $stmt = $this->connection->prepare("INSERT INTO transactions_users (transaction_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $transaction_id, $user_id);
        $stmt->execute();
        $stmt->close(); // close the statement

    }
    
    /**
     * a functiont that edit the quantity for a created  transaction 
     *
     * @param int $quantity_difference
     * @param int $item_id
     * @return void
     */
    public function edit_quantity($quantity_difference, $item_id)
    {
        $stmt = $this->connection->prepare("UPDATE `items` SET quantity = quantity - ? WHERE id= ?");
        $stmt->bind_param("ii", $quantity_difference, $item_id);
        $stmt->execute();
        $stmt->close(); // close the statement
    }

    /**
     * a function that reset the quantity of an item to its original value, the function is used with delete request only
     *
     * @param int $quantity
     * @param int $item_id
     * @return void
     */
    public function reset_quantity($quantity, $item_id)
    {
        $stmt = $this->connection->prepare("UPDATE items SET quantity = quantity + ? WHERE id=?");
        $stmt->bind_param("ii", $quantity, $item_id);
        $stmt->execute();
        $stmt->close(); // close the statement
    }


    /**
     * a function that delete a row from the table that has a relation between transaction_id and user_id, the function used with delete request only
     *
     * @param int $id
     * @return void
     */
    public function delete_relation($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM transactions_users WHERE transaction_id= ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close(); // close the statmenet
    }
}
