<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 9/15/2018
 * Time: 8:44 PM
 */

class loginRequest
{
    private $username;
    private $password;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }
}