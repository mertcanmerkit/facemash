<?php

class Category
{
    /**
     * @var PDO
     */
    private $db = null;
    private $user = null;
    //private $imageId = null;

    /**
     * @param $db
     * @param $user User
     */
    public function __construct($db, $user = null)
    {
        if ($user != null) {
            $this->user = $user->getUser();
        }
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
        if ($rowCount <= 0) {
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
        $sthCategoryData = $this->db->prepare("insert into categoryData (categoryId,imageId) values (:category_id, :imageId)");
        $sthCategoryData->execute(array("category_id" => $categoryId, "imageId" => $imageId));


        return true;
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

    public function getCategoriesForIndex($page)
    {
        if ($page != 1) {
            $limit = (($page - 1) * 16) . "," ($page * 16);
        } else {
            $limit = "0,16";
        }

        $sth = $this->db->prepare(" select distinct categoryId, SUM(count) as sumCount from categoryData group by categoryId order by sumCount desc limit " . $limit);
        $sth->execute();
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $renderedData = "";
        $lastColor = "";
        foreach ($fth as $categoryData) {
            $categoryId = $categoryData["categoryId"];
            $categoryImages = $this->getCategoryImages($categoryId);
            $categoryName = $this->getCategoryNameWithCategoryId($categoryId);
            $categoryCard = new CategoryCard($categoryId, $categoryImages, $categoryName, $lastColor);
            $lastColor = $categoryCard->lastColor;
            $renderedData .= $categoryCard->render();
        }
        return $renderedData;

    }

    private function getCategoryImages($categoryId)
    {
        $sth = $this->db->prepare("select * from categoryData where categoryId = :catid");
        $sth->execute(array("catid" => $categoryId));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $arr = array();
        foreach ($fth as $categoryData) {
            array_push($arr, $this->getImageWithImageId($categoryData["imageId"]));
        }
        return $arr;
    }

    private function getCategoryNameWithCategoryId($categoryId)
    {
        $sth = $this->db->prepare("select name from categories where id = :catid");
        $sth->execute(array("catid" => $categoryId));
        return $sth->fetch(PDO::FETCH_ASSOC)["name"];
    }

    private function getImageWithImageId($imageId)
    {
        $sth = $this->db->prepare("select username from images where id = :id");
        $sth->execute(array("id" => $imageId));
        return $sth->fetch(PDO::FETCH_ASSOC)["username"];
    }

}