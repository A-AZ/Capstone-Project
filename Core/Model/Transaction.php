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
        $stmt = $this->connection->prepare("SELECT SUM(total_sales) as sum_total_sales FROM $this->table");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return (int) $result->fetch_object()->sum_total_sales; // return the results as an inter
    }
}
