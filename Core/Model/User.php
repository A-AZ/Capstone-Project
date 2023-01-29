<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{
    //assign the permissions array to a constant 
    const ADMIN = array(
        "items:create", "items:read", "items:update", "items:delete",
        "transactions:create", "transactions:read", "transactions:update", "transactions:delete",
        "users:create", "users:read", "users:update", "users:delete",
        "dashboard:read",
    );
    const PROCUREMENT = array(
        "items:create", "items:read", "items:update", "items:delete",
    );
    const ACCOUNTANT = array(
        "transactions:read", "transactions:update", "transactions:delete",
    );
    const SELLER = array(
        "transactions:create",
    );

    /**
     * check the username in the users table
     *
     * @param string $username
     * @return object
     */
    public function check_username(string $username)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE username= ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result) {
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * get the permissions array by user id in the session variable
     *
     * @return array
     */
    public function get_permissions(): array
    {
        $permissions = array();
        $user = $this->get_by_id($_SESSION['user']['id']);
        if ($user) {
            $permissions = \unserialize($user->permissions); //unserialize the permissions that returned from the db
        }
        return $permissions;
    }
}
