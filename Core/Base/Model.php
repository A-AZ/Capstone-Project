<?php

namespace Core\Base;

class Model
{
    public $connection;
    protected $table;

    /**
     * open the connection with DB
     */
    public function __construct()
    {
        $this->connection(); // connect with database
        $this->relate_table(); // dynamic functions to select required table from DB
    }
    /**
     * close the connecetion after finishing the query
     */
    public function __destruct()
    {
        $this->connection->close();
    }
    /**
     * get all the rows from a table
     *
     * @return array
     */
    public function get_all(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * to get a specific row from a table in DB and also prevent sql injections
     *
     * @param  $id
     * @return
     */
    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_object();
    }

    /**
     * dynamic function to create a row in DB and also prevent sql injections
     *
     * @param $data
     * @return void
     */
    public function create($data)
    {
        $keys = '';
        $values = '';
        $data_types = '';
        $value_arr = array();

        foreach ($data as $key => $value) {

            if ($key != \array_key_last($data)) {
                $keys .= $key . ', ';
                $values .= "?, ";
            } else {
                $keys .= $key;
                $values .= "?";
            }

            switch ($key) {
                case 'id':
                case 'selling_price':
                case 'cost_price':
                case 'quantity':
                case 'total_sales':
                case 'item_id':
                case 'user_id':
                case 'transaction_id':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }
            $value_arr[] = $value;
        }

        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * dynamic function to update a certain row in DB and also prevent sql injections
     *
     * @param [type] $data
     * @return void
     */
    public function update($data)
    {
        $id = 0;
        $data_types = '';
        $value_arr = array();
        $set_values = '';
        foreach (($data) as $key => $value) {
            if ($key == 'id') {
                $id = $value;
                continue;
            }
            if ($key != \array_key_last($data)) {
                $set_values .= "$key=?, ";
            } else {
                $set_values .= "$key=?";
            }

            switch ($key) {
                case 'id':
                case 'selling_price':
                case 'cost_price':
                case 'quantity':
                case 'total_sales':
                case 'item_id':
                case 'user_id':
                case 'transaction_id':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }
            $value_arr[] = $value;
        }
        $sql = "UPDATE $this->table SET $set_values WHERE id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr);
        $stmt->execute();
        $stmt->close();
    }

    /**
     *  dynamic function to delete a certain row in DB and also prevent sql injections
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * create connection with the DB 
     *
     * @return void
     */
    protected function connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pos_demo";

        $this->connection = new \mysqli($servername, $username, $password, $database);

        // check the connection status
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    /**
     * dynamic fuction to select a table in DB based on conreoller name class
     *
     * @return void
     */
    protected function relate_table()
    {
        $table_name = \get_class($this);
        $table_name_arr = \explode('\\', $table_name);
        $class_name = $table_name_arr[\array_key_last($table_name_arr)];
        $final_clas_name = \strtolower($class_name) . "s";
        $this->table = $final_clas_name;
    }

    /**
     * a function that get user id for a created transaction (i.e who created the transaction)
     *
     * @param [type] $id
     * @return 
     */
    public function related_user($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM transactions_users WHERE transaction_id= ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_object();
    }
}
