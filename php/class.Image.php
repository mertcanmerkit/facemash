<?php

class Image
{
    private $igUserName;
    private $conn;

    public function __construct($igUserName)
    {
        $this->igUserName = $igUserName;
        $conn = new Connection("https://instagram.com/" . $igUserName . "/?__a=1");
        $this->conn = $conn;
    }

    public function getImage()
    {
        if ($this->checkCache()) {
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

                return $file;
            }
        }
        return null;
    }

    private function checkCache()
    {
        return file_exists(__DIR__ . "/../assets/InstagramProfilePictures/" . $this->igUserName . ".jpg");
    }

}