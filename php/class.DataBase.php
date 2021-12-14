<?php

class DataBase
{
    public $db = null;

    public function __construct()
    {
        try {

            $db = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $db->exec("SET CHARSET UTF8");
            $db->exec("SET NAMES UTF8");
        } catch (PDOException $e) {

            die ("Hata var " . $e);
        }
        $this->db = $db;
    }

    /**
     * @return PDO|null
     */
    public function getDb(): ?PDO
    {
        if ($this->db == null) {
            die("database error");
        }
        return $this->db;
    }

// username = osman, pass = asd.1234, email = tr@tr.tr, token = askljfalf, ip = 192.162
    public function addUser($array)
    {
        unset($array["operation"]);
        $array["token"] = generateRandomString();
        $array["ip"] = getIpAdress();
        foreach ($array as $key => $value) {
            if (empty($value) || $value == null) {
                return array("error" => true, "reason" => "Check all inputs");
            }
        }
        $fields = array_keys($array); // here you have to trust your field names!
        $values = array_values($array);
        $fieldlist = implode(',', $fields);
        $qs = str_repeat("?,", count($fields) - 1);
        $sql = "insert into users($fieldlist) values(${qs}?)";
        $q = $this->db->prepare($sql);
        if ($q->execute($values)) {
            return array("error" => false, "token" => $array["token"]);
        } else {
            return array("error" => true, "reason" => "Database Error", "errorCode" => $q->errorCode());
        }
    }

    public function addPassKey($array)
    {
        unset($array["operation"]);
        $array["secretKey"] = generateRandomString(50);
        $array["ip"] = getIpAdress();
        foreach ($array as $key => $value) {
            if (empty($value) || $value == null) {
                return array("error" => true, "reason" => "Check all inputs");
            }
        }
        $fields = array_keys($array); // here you have to trust your field names!
        $values = array_values($array);
        $fieldlist = implode(',', $fields);
        $qs = str_repeat("?,", count($fields) - 1);
        $sql = "insert into passwordReset($fieldlist) values(${qs}?)";
        $q = $this->db->prepare($sql);
        if ($q->execute($values)) {
            return array("reset" => true, "secretKey" => $array["secretKey"]);
        } else {
            return array("error" => true, "reason" => "Database Error", "errorCode" => $q->errorCode());
        }
    }

    public function updatePass($array)
    {
        unset($array["operation"]);
        $pass = $_POST["pass"];
        $secretKey = $_POST["secretKey"];

        foreach ($array as $key => $value) {
            if (empty($value) || $value == null) {
                return array("error" => true, "reason" => "Check all inputs");
            }
        }

        $sth = $this->db->prepare("SELECT email FROM passwordReset WHERE secretKey = :secretKey");
        $sth->execute(array(
            "secretKey" => $secretKey
        ));
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        $rowCount = $sth->rowCount();

        if ($rowCount > 0) {
            $email = $result["email"];

            $sql = "UPDATE users SET pass='$pass' WHERE email='$email'";
            $q = $this->db->prepare($sql);
            $q->execute();

            $sth = $this->db->prepare("DELETE FROM passwordReset WHERE secretKey = :secretKey");
            $sth->execute(array(
                "secretKey" => $secretKey
            ));

            return array("changePass" => true, "reason" => "Succes");
        } else {
            return array("changePass" => false, "reason" => "Secret key undefinded");
        }
    }


    public function addNewImage($igUserName)
    {
        $user = new User($this->db);
        if (!$user->checkLoginWithToken($_COOKIE[COOKIE_NAME])) {
            die("error for login");
        }

        $sth = $this->db->prepare("insert into images(username,adder) values(:username,:adder)");
        $sth->execute(array(
            "username" => $igUserName,
            "adder" => $user->getUser()["id"]
        ));
        return $this->db->lastInsertId();
    }

    public function getImageIdWithUsername($igUserName)
    {
        $sth = $this->db->prepare("select id from images where username = ?");
        $sth->execute(array($igUserName));
        $fth = $sth->fetch(PDO::FETCH_ASSOC);
        return $fth["id"];
    }

}