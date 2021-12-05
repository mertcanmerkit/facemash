<?php

class User
{
    /**
     * @var PDO
     */
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function checkLoginWithToken($token)
    {
        
    }

    public function checkLoginWithCredentials($username, $pass)
    {

    }


}