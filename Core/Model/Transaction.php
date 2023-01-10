<?php

namespace Core\Model;

use Core\Base\Model;

class Transaction extends Model
{

    /**
     * function to sum the total_sales culomne in transactions table
     *
     * @return integer
     */
    public function sum_total_sales(): int
    {
        $result = $this->connection->query("SELECT SUM(total_sales) as sum_total_sales FROM $this->table"); // send query to db to get sum the total sales value and assign it to sum_total_sales 
        $row = $result->fetch_object();

        return (int) $row->sum_total_sales; // return the results as an inter
    }
}
