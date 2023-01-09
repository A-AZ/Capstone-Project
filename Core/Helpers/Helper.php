<?php

namespace Core\Helpers;

use Core\Model\User;

class Helper
{/**
 * redirect the user to specific page
 *
 * @param string $url
 * @return void
 */
    public static function redirect(string $url): void
    {
        header("Location: $url");
    }

    /**
     * check permissions for the logged in user
     *
     * @param array $permissions_set
     * @return void
     */
    public static function check_permissions(array $permissions_set)
    {

        if (!isset($_SESSION['user'])){
            return false;
        }

        $user = new User;
        
        $assigned_permissions = $user->get_permissions();
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)){
                return false;
            }
        } return true;
    }

}
