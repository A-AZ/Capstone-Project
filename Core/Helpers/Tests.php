<?php

namespace Core\Helpers;

use Exception;

trait Tests
{
    /**
     * check if the input exprestion is exist, if false thorw exception message and exit
     *
     * @param [type] $expr
     * @param [type] $msg
     * @return void
     */
    protected static function check_if_exists($expr, $msg)
    {
        try {
            if (!$expr) {
                throw new \Exception($msg);
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die;
        }
    }

    /**
     * check if the variable empty or not, if empty throw exception message and exit
     *
     * @param [type] $var
     * @return void
     */
    protected static function check_if_empty($var)
    {
        try {
            if (empty($var)) {
                throw new \Exception("Empty data");
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die;
        }
    }
}
