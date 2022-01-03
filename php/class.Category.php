<?php

class Category
{
    /**
     * @var PDO
     */
    private $db = null;
    private $user = null;

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

    public function getRenderedCategory($categoryId)
    {
        $sth = $this->db->prepare("select distinct categoryId, SUM(count) as sumCount from categoryData WHERE categoryId= :categoryId group by categoryId order by sumCount");
        $sth->execute(array("categoryId" => $categoryId));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $renderedData = "";
        $lastColor = "";
        $user = new User($this->db);
        foreach ($fth as $categoryData) {
            $categoryId = $categoryData["categoryId"];
            $categoryImages = $this->getCategoryImages($categoryId);
            $categoryName = $this->getCategoryNameWithCategoryId($categoryId);
            $categoryCard = new CategoryCard($categoryId, $categoryImages, $categoryName, $lastColor, $user->getUser());
            $lastColor = $categoryCard->lastColor;
            $renderedData .= $categoryCard->render();
        }
        return $renderedData;
    }

    public function getCategoriesForIndex($page)
    {
        if ($page != 1) {
            $limitRow = $page * 8;
            $limit = $limitRow . ",8";
            //   sleep(2);
        } else {
            $limit = "0,8";
        }

        $sth = $this->db->prepare(" select distinct categoryId, SUM(count) as sumCount from categoryData group by categoryId order by sumCount desc limit " . $limit);
        $sth->execute();
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $renderedData = "";
        $lastColor = "";
        $user = new User($this->db);
        foreach ($fth as $categoryData) {
            $categoryId = $categoryData["categoryId"];
            $categoryImages = $this->getCategoryImages($categoryId);
            $categoryName = $this->getCategoryNameWithCategoryId($categoryId);
            $categoryCard = new CategoryCard($categoryId, $categoryImages, $categoryName, $lastColor, $user->getUser());
            $lastColor = $categoryCard->lastColor;
            $renderedData .= $categoryCard->render();
        }
        return $renderedData;

    }

    public function getUserCategories($page)
    {
        if ($page != 1) {
            $limitRow = $page * 8;
            $limit = $limitRow . ",8";
            //    sleep(2);
        } else {
            $limit = "0,8";
        }
        $user = new User($this->db);
        $user_id = $user->getUser()["id"];
        $categoryIds = $user->getUserAddedCategories($user_id);
        $categoryIdsArr = array();
        foreach ($categoryIds as $categoryId) {
            $categoryIdsArr[] = $categoryId["id"];
        }
        $categoryIdsStr = implode(",", $categoryIdsArr);
        if (!$categoryIds) {
            die();
        }
        $q = "select distinct categoryId, SUM(count) as sumCount from categoryData WHERE categoryId IN (" . $categoryIdsStr . ") group by categoryId order by sumCount desc limit " . $limit;
        $sth = $this->db->prepare($q);
        $sth->execute();
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $renderedData = "";
        $lastColor = "";
        foreach ($fth as $categoryData) {
            $categoryId = $categoryData["categoryId"];
            $categoryImages = $this->getCategoryImages($categoryId);
            $categoryName = $this->getCategoryNameWithCategoryId($categoryId);
            $categoryCard = new CategoryCard($categoryId, $categoryImages, $categoryName, $lastColor, $user->user);
            $lastColor = $categoryCard->lastColor;
            $renderedData .= $categoryCard->render();
        }
        return $renderedData;

    }

    public function getCategoryImages($categoryId)
    {
        $sth = $this->db->prepare("select * from categoryData where categoryId = :catid");
        $sth->execute(array("catid" => $categoryId));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $arr = array();
        foreach ($fth as $categoryData) {
            array_push($arr, encryptOrDecrypt($this->getImageWithImageId($categoryData["imageId"])));
        }
        return $arr;
    }

    public function getCategoryNameWithCategoryId($categoryId)
    {
        $sth = $this->db->prepare("select name from categories where id = :catid");
        $sth->execute(array("catid" => $categoryId));
        return $sth->fetch(PDO::FETCH_ASSOC)["name"];
    }

    public function getCategorySumCount($categoryId)
    {
        $sth = $this->db->prepare("select distinct categoryId, SUM(count) as sumCount from categoryData WHERE categoryId= :categoryId group by categoryId order by sumCount");
        $sth->execute(array("categoryId" => $categoryId));
        return $sth->fetch(PDO::FETCH_ASSOC)["sumCount"];
    }

    public function addImageToCategory($categoryId, $imageId)
    {
        $sth = $this->db->prepare("insert into categoryData (categoryId,imageId) values (?,?)");
        $sth->execute(array(
            $categoryId,
            $imageId
        ));
        $sth->fetch();
        return true;
    }

    public function getImageWithImageId($imageId)
    {
        $sth = $this->db->prepare("select username from images where id = :id");
        $sth->execute(array("id" => $imageId));
        return $sth->fetch(PDO::FETCH_ASSOC)["username"];
    }

    public function getAllImagesWithCategoryId($categoryId, $ignoreVoters = true, $shuffle = true)
    {
        if ($ignoreVoters) {
            $this->user = new User($this->db);
            $this->user->getUser();
        }
        $sth = $this->db->prepare("select id,imageId,voters,count from categoryData where categoryId = ? order by count desc");
        $sth->execute(array($categoryId));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $arr = array();
        $categoryName = $this->getCategoryNameWithCategoryId($categoryId);
        if ($shuffle) {
            shuffle($fth);
        }

        foreach ($fth as $categoryData) {
            if (count($arr) == 2 && $ignoreVoters)
                return $arr;
            if ($ignoreVoters) {
                $count = $categoryData["count"];
                $voters = $categoryData["voters"];
                $explodedVoters = explode(",", $voters);
                $isBreak = false;
                foreach ($explodedVoters as $explodedVoter) {
                    if (!$this->user->user) {
                        jsonDie(array("error" => true, "reason" => "Please Login"));
                    }
                    if ($explodedVoter == $this->user->user["id"]) {
                        $isBreak = true;
                    }
                }
                if ($isBreak) {
                    continue;
                }
            }
            $sthImage = $this->db->prepare("select username from images where id = ?");
            $sthImage->execute(array($categoryData["imageId"]));
            $fthImage = $sthImage->fetch(PDO::FETCH_ASSOC);
            $encryptData = encryptOrDecrypt($fthImage["username"]);
            $arr[] = array("image" => $encryptData, "name" => $fthImage["username"], "categoryName" => $categoryName, "count" => $categoryData["count"], "categoryId" => encryptOrDecrypt($categoryData["id"]));

        }
        return $arr;

    }

    public
    function checkInCategory($categoryId, $image)
    {
        $imageID = $image->imageId;
        $sth = $this->db->prepare("select id from categoryData where (categoryId = :cat_id and imageId = :imageid)");
        $sth->execute(array("cat_id" => $categoryId, "imageid" => $imageID));
        return $sth->fetch();
    }

    public function getTotalImageCount($categoryId)
    {
        $sth = $this->db->prepare("select COUNT(id) as idCount from categoryData where categoryId = ? ");
        $sth->execute(array($categoryId));
        return $sth->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getAllCategoryIds()
    {
        $sth = $this->db->prepare("select id from categories ");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandomCategoryId($array = null)
    {
        if ($array == null)
            $array = $this->getAllCategoryIds();
        shuffle($array);
        if ($this->getTotalImageCount($array[0]["id"])["idCount"] < 2) {
            $this->getRandomCategoryId($array);
        }
        return $array[0]["id"];

    }


}