<?php

$allVoterData = $voter->getAllVoterData();
include __DIR__ . "/modal.php";
?>

<div class="container">
    <div class="row">
        <div class="col-lg-2 d-flex justify-content-center">
            <div class="row mt-3">
                <div class="col ">
                    <img class="rounded img-fluid mx-auto d-block profile-photo"
                         src="/php/Image.php?name=<?= $allVoterData["imageUrl"] ?>">
                    <a href="https://www.instagram.com/<?= $allVoterData["name"] ?>/" target="_blank">
                        <h5 class="mt-2 text-lg-start text-center <?= generateRandomColor() ?>-text">@<?= $allVoterData["name"] ?></h5>
                    </a>
                    <div class="badges text-lg-start text-center mt-3 mb-3">
                        <?php
                        $lastColor = "";
                        foreach ($allVoterData["categories"] as $voterData) {
                            $randomColor = generateRandomColor($lastColor);
                            $kingBadge = "";
                            if ((int)$voterData["sorting"] == 1){
                                $kingBadge = '<i class="fas fa-crown mb-1 mt-1 d-lg-block"></i>';
                            }
                            ?>
                            <span class="badge text-wrap mb-2 bg-<?= $randomColor ?> "
                                  onclick="startModalWithCategory('<?= $voterData["id"] ?>')" style="cursor:pointer;"> <?=$kingBadge?>
                               #<?= $voterData["sorting"] ?> <?= $voterData["name"] ?>
                            </span>

                            <?php
                            $lastColor =$randomColor;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-10">
            <?php
            $categoryCount = count($allVoterData["categories"]);
            $class = "";
            if($categoryCount > 2){
                $class = "justify-content-lg-center";
            }
            ?>



            <div class="row d-flex <?=$class?>">
                <?php
                echo $voter->renderCategories();
                ?>
            </div>
        </div>
    </div>
</div>

