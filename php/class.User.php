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

    public function verifyCredentials(array $post, $state)
    {

        if ($state == 0) {
            $key = "username";
        } else {
            $key = "email";
        }
        $sql = $this->db->prepare("select id from users where " . $key . " = :username ");
        if ($state == 0) {
            $sql->execute(array(
                "username" => $post["username"]
            ));
        } else {
            $sql->execute(array(
                "username" => $post["email"]
            ));
        }
        $rowCount = $sql->rowCount();
        if ($state == 0) {
            if ($rowCount == 0) {
                return $this->verifyCredentials($post, 1);
            } else {
                return array("status" => false, "reason" => "username");
            }
        } else {
            if ($rowCount == 0) {
                return array("status" => true);
            } else {
                return array("status" => false, "reason" => "email");
            }
        }
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
                return $this->checkLoginWithCredentials($username, $pass, 1);
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