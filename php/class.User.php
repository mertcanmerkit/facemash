<?php

class User
{
    /**
     * @var PDO
     */
    public $db = null;
    public $token = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function checkLoginWithToken($token)
    {
        $sql = $this->db->prepare("select id from users where token = :tkn");
        $sql->execute(array(
            "tkn" => $token
        ));
        $sql->fetch();
        $rowCount = $sql->rowCount();
        if ($rowCount > 0) {
            $this->token = $token;
            return true;
        } else {
            return false;
        }
    }

    public function checkLoginWithCredentials($username, $pass, $state)
    {

        if ($state == 0) {
            $sql = $this->db->prepare("select token from users where username = :username and pass = :pass");
        } else {
            $sql = $this->db->prepare("select token from users where email = :username and pass = :pass");
        }
        $sql->execute(array(
            "username" => $username,
            "pass" => $pass
        ));
        $fth = $sql->fetch(PDO::FETCH_ASSOC);

        $rowCount = $sql->rowCount();
        if ($rowCount > 0) {
            $this->token = $fth["token"];
            return true;
        } else {
            if ($state == 1) {
                return false;
            } else {
                $this->checkLoginWithCredentials($username, $pass, 1);
            }
        }
        return null;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

}