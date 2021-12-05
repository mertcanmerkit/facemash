<?php

class DataBase
{
    public $db = null;

    public function __construct()
    {
        try {

            $db = new PDO("mysql:host=localhost;dbname=facemash", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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
        return $this->db;
    }


}