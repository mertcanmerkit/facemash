<?php

class Image
{
    private $igUserName;
    private $conn;
    private $db;
    public $imageId = null;

    public function __construct($igUserName)
    {
        $this->igUserName = $igUserName;
        $conn = new Connection("https://instagram.com/" . $igUserName);
        $this->conn = $conn;
        $this->db = new DataBase();
    }

    public function getImage()
    {
        if ($this->checkCache()) {
            $this->imageId = $this->db->getImageIdWithUsername($this->igUserName);

            return file_get_contents(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg");
        } else {
            $url = $this->conn->getImageUrlWithoutPage();
            if ($url == null)
                jsonDie(array("error" => true, "reason" => "user not found"));

            $file = file_get_contents($url);
            file_put_contents(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg", $file);
            $this->imageId = $this->db->addNewImage($this->igUserName);
            return $file;

        }
    }

    private function checkCache()
    {
        return file_exists(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg");
    }

    public function checkImageInDatabase($name)
    {
        $sth = $this->db->db->prepare("select id from images where username = ?");
        $sth->execute(array($name));
        $sth->fetch();
        $rowCount = $sth->rowCount();
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getErrorImage()
    {
        return file_get_contents(__DIR__ . "/../views/img/danger.jpg");
    }

}