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
        $conn = new Connection("https://instagram.com/" . $igUserName . "/?__a=1");
        $this->conn = $conn;
        $this->db = new DataBase();
    }

    public function getImage()
    {
        if ($this->checkCache()) {
            $this->imageId = $this->db->getImageIdWithUsername($this->igUserName);

            return file_get_contents(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg");
        } else {
            $json = json_decode($this->conn->getBodyWithoutPage(), true);
            if (isset($json["graphql"])) {
                $imageUri = null;
                if (isset($json["graphql"]["user"]["profile_pic_url_hd"])) {
                    $imageUri = $json["graphql"]["user"]["profile_pic_url_hd"];
                } else {
                    $imageUri = $json["graphql"]["user"]["profile_pic_url"];
                }
                $file = file_get_contents($imageUri);
                file_put_contents(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg", $file);
                $this->imageId = $this->db->addNewImage($this->igUserName);

                return $file;
            }
        }
        return null;
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