<?php

class CategoryCard
{

    private $categoryId, $imagesArray, $name, $color;
    public $lastColor;
    private $user = null;

    public function __construct($categoryId, $imagesArray, $name, $lastColor, $user = null)
    {
        $this->categoryId = $categoryId;
        $this->imagesArray = $imagesArray;
        $this->name = $name;
        $this->lastColor = $lastColor;
        $this->color = $this->generateColor();
        $this->user = $user;

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
        <h5 class="' . $this->color . '-text text-break" style="padding: 1rem 1rem 0rem 1rem;"><a href="/category/' . $this->categoryId . '"> ' . $this->name . '</a><a href="add-photo/' . $this->categoryId . '">
                <i class="far fa-plus-square float-end"></i>
            </a>
        </h5>
        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-id-' . $this->categoryId . '" data-bs-ride="carousel">
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
 <img src="/php/Image.php?name=' . $image . '" class="card-img img-category-' . $this->categoryId . '" alt="' . encryptOrDecrypt($image, "decrypt") . '">
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
                <button type="button" class="btn btn-outline-primary start-btn ' . $this->color . '-border ' . $this->color . '-text fw-bold" id="startMashBtn" onclick="startModalWithCategory(\'' . $this->categoryId . '\')">
                ' . $this->getStartOrRestart() . '
                </button>
                      </div>
        </div>
        <script>
       $(".img-category-' . $this->categoryId . '").on("load",function(){
        const height = $($(".carousel-id-' . $this->categoryId . '")).height();
        $(".carousel-id-' . $this->categoryId . '").css("min-height", height);
       
       });
        </script>
        ';
    }

    private function getStartOrRestart()
    {
        if ($this->user == null)
            return "Start";
        if ($this->user["finishedCategories"] == $this->categoryId)
            return "Restart";
        if (in_array($this->categoryId, explode(",", $this->user["finishedCategories"])))
            return "Restart";
        return "Start";
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