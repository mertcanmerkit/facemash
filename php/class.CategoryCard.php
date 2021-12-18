<?php

class CategoryCard
{

    private $categoryId, $imagesArray, $name, $color;
    public $lastColor;

    public function __construct($categoryId, $imagesArray, $name, $lastColor)
    {
        $this->categoryId = $categoryId;
        $this->imagesArray = $imagesArray;
        $this->name = $name;
        $this->lastColor = $lastColor;
        $this->color = $this->generateColor();


    }

    public function render()
    {
        $head = $this->renderHead();
        $body = $this->renderBody();
        $footer = $this->renderFooter();
        return $head . $body . $footer;
    }

    private function renderHead()
    {
        return '<div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
    <div class="card card-shadow-' . $this->color . ' img-cards">
        <h5 class="' . $this->color . '-text text-break" style="padding: 1rem 1rem 0rem 1rem;"> ' . $this->name . '<a href="add-photo?id=' . $this->categoryId . '">
                <i class="far fa-plus-square float-end"></i>
            </a>
        </h5>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
        ';
    }

    private function renderBody()
    {
        $str = "";
        $i = 1;
        foreach ($this->imagesArray as $image) {

            if ($i == 1) {
                $str .= '
                <div class="carousel-item active">
                    <div class="card-body">
                        <div class="row">';
            } else if (($i - 1) % 6 == 0) {
                $str .= '
                </div></div></div><div class="carousel-item">
                    <div class="card-body">
                        <div class="row">
                        ';
            }
            $str .= '<div class="col-4 mb-3">
 <img src="/php/Image.php?name=' . $image . '" class="card-img" alt="' . encryptOrDecrypt($image, "decrypt") . '">
  </div>
  ';

            $i++;
        }
        $str .= "
</div></div></div>
";
        return $str;

    }

    private function renderFooter()
    {
        return ' </div>
                </div>
                <button type="button" class="btn btn-outline-primary start-btn ' . $this->color . '-border ' . $this->color . '-text fw-bold" onclick="startModalWithCategory(\'' . $this->categoryId . '\')">Start
                </button>
                      </div>
        </div>';
    }

    private function generateColor()
    {
        $colorArray = array("blue", "yellow", "green", "pink", "red");
        $rand_keys = array_rand($colorArray, 2);
        $color = $colorArray[$rand_keys[0]];
        if ($color == $this->lastColor) {
            return $this->generateColor();
        }
        $this->lastColor = $color;
        return $color;
    }

}