<?php

class Voter
{
    /**
     * @var PDO
     */
    public $db = null;
    public $userName = null;
    public $isVoterExist = false;
    /**
     * @var Category
     */
    private $category = null;
    private $id;
    private $allData = null;

    public function __construct($db, $userName)
    {
        $this->db = $db;
        if (str_starts_with($userName, "@")) {
            $this->userName = substr($userName, 1);
        } else {
            $this->userName = $userName;
        }
        $this->isVoterExist = $this->checkVoterIsExist();
        $this->category = new Category($db);
    }

    public function checkVoterIsExist()
    {
        $sth = $this->db->prepare("select id from images where username = ?");
        $sth->execute(array($this->userName));
        $fth = $sth->fetch(PDO::FETCH_ASSOC);
        $rowCount = $sth->rowCount();
        if ($rowCount <= 0) {
            return false;
        }
        $this->id = $fth["id"];
        return true;
    }

    public function getAllVoterData()
    {
        $allData = array();
        $allData["topVoteCount"] = $this->getTopVoteCount();
        $allData["id"] = $this->id;
        $allData["categories"] = $this->getAllCategories();
        $allData["imageUrl"] = encryptOrDecrypt($this->category->getImageWithImageId($this->id));
        $allData["name"] = $this->userName;
        $this->allData = $allData;

        return $allData;
    }


    private function getTopVoteCount()
    {
        $sth = $this->db->prepare("select count from categoryData where imageId = ?");
        $sth->execute(array($this->id));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $topCount = 0;
        foreach ($fth as $categoryData) {
            $topCount += (int)$categoryData["count"];
        }

        return $topCount;
    }

    private function getAllCategories()
    {
        $sth = $this->db->prepare("select categoryId from categoryData where imageId = ?");
        $sth->execute(array($this->id));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();
        foreach ($fth as $categoryData) {

            $categories[] = array(
                "name" => $this->category->getCategoryNameWithCategoryId($categoryData["categoryId"]),
                "id" => $categoryData["categoryId"],
                "sorting" => $this->getSortingWithCategoryId($categoryData["categoryId"])
            );
        }
        usort($categories, function ($item1, $item2) {
            return $item1['sorting'] <=> $item2['sorting'];
        });
        return $categories;
    }

    private function getSortingWithCategoryId($categoryId)
    {
        $sth = $this->db->prepare("select imageId from categoryData where categoryId = ? order by count desc");
        $sth->execute(array($categoryId));
        $fth = $sth->fetchAll(PDO::FETCH_ASSOC);
        $score = 1;
        foreach ($fth as $categoryData) {
            if ($categoryData["imageId"] == $this->id) {
                return $score;
            }
            $score++;
        }
        return 0;
    }

    public function renderCategories()
    {
        $lastColor = null;
        $renderedData = "";
        foreach ($this->allData["categories"] as $category) {

            $categoryImages = $this->category->getCategoryImages($category["id"]);
            $categoryCard = new CategoryCard($category["id"], $categoryImages, $category["name"], $lastColor);
            $lastColor = $categoryCard->lastColor;
            $renderedData .= $categoryCard->render();
        }
        return $renderedData;
    }


}