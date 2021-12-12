<?php

class Category
{
    /**
     * @var PDO
     */
    private $db = null;
    private $imageId = null;

    /**
     * @param $db
     * @param $user User
     */
    public function __construct($db, $user)
    {
        $this->user = $user->getUser();
        $this->db = $db;
    }

    public function addCategory($categoryName, $firstUsername)
    {
        if ($this->checkCategory($categoryName)) {
            $createImage = $this->createImage($firstUsername);
            if ($createImage) {
                $createCategory = $this->createCategory($categoryName, $createImage);
                if ($createCategory) {
                    return array("error" => false);
                } else {
                    return array("error" => true, "reason" => "Error code 0x000452");
                }
            } else {
                return array("error" => true, "reason" => "Error code 0x000451");

            }
        } else {
            return array("error" => true, "reason" => "This category already created.");
        }
    }

    public function checkCategory($categoryName)
    {
        $sth = $this->db->prepare("select id from categories where name = ?");
        $sth->execute(array($categoryName));
        $sth->fetch(PDO::FETCH_ASSOC);
        $rowCount = $sth->rowCount();
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function createCategory($categoryName, $imageId)
    {
        $sth = $this->db->prepare("INSERT INTO `categories` ( `adder`, `name`) VALUES ( :adderId, :category_name);");
        $sth->execute(array("adderId" => $this->user["id"], "category_name" => $categoryName));
        $sth->fetch();

        $categoryId = $this->db->lastInsertId();
        $sthCategoryData = $this->db->prepare("insert into categoryData (category_id,imageId) values (:category_id, :imageId)");
        $sthCategoryData->execute(array("category_id" => $categoryId, "imageId" => $imageId));


        return "";
    }

    private function createImage($firstUsername)
    {
        $image = new Image($firstUsername);
        if ($image->getImage() != null) {
            if ($image->imageId != null) {
                return $image->imageId;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

}