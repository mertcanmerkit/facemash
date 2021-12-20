<?php

class User
{
    /**
     * @var PDO
     */
    public $db = null;
    public $token = null;
    public $user = null;

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
                // username Already in Use error
                return array("error" => true, "reason" => "username");
            }
        } else {
            if ($rowCount == 0) {
                return array("error" => false);
            } else {
                // Email Already in Use error
                return array("error" => true, "reason" => "email");
            }
        }
    }

    public function checkLoginWithToken($token = "empty")
    {
        if ($token == "empty") {
            $token = @$_COOKIE[COOKIE_NAME];
        }
        $sql = $this->db->prepare("select id from users where token = :tkn");
        $sql->execute(array(
            "tkn" => $token
        ));
        $sql->fetch();
        $rowCount = $sql->rowCount();
        if ($rowCount > 0) {
            $this->token = $token;
            $this->user = $this->getUser();
            return true;
        } else {
            return false;
        }
    }

    public function checkLoginWithCredentials($username, $pass, $state)
    {

        if ($state == 0) {
            $sql = $this->db->prepare("select token from users where username = ? and pass = ?");
        } else {
            $sql = $this->db->prepare("select token from users where email = ? and pass = ?");
        }
        $sql->execute(array(
            $username,
            $pass
        ));
        $fth = $sql->fetch(PDO::FETCH_ASSOC);
        $rowCount = $sql->rowCount();
        if ($rowCount > 0) {
            $this->token = $fth["token"];
            $this->user = $this->getUser();

            return true;
        } else {
            if ($state == 1) {
                return false;
            } else {
                return $this->checkLoginWithCredentials($username, $pass, 1);
            }
        }
    }

    public function getUser()
    {
        $sth = $this->db->prepare("select * from users where token = ?");
        $sth->execute(array($this->getToken()));
        $user = $sth->fetch(PDO::FETCH_ASSOC);
        $this->user = $user;
        return $user;
    }

    public function getUserAddedCategories($id)
    {
        $sth = $this->db->prepare("select id from categories where adder= ?");
        $sth->execute(array($id));
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        if ($this->token == null) {
            $this->token = $_COOKIE[COOKIE_NAME];
        }
        return $this->token;
    }


}