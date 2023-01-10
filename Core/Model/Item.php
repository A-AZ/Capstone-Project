<?php

namespace Core\Model;

use Core\Base\Model;

class Item extends Model
{
    /**
     * sellecting the top 5 rows from items table and order it by selling price (descending) 
     *
     * @return array
     */
    public function top_expensive(): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table ORDER BY selling_price DESC LIMIT 5"); // send query to db to get sum the total sales value and assign it to sum_total_sales 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }

            return $data;
        }
    }
}
