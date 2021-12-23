<?php
$categoryId = $explodedUrl[1];

$renderedCategory = $category->getRenderedCategory($categoryId);
$categorySumCount = $category->getCategorySumCount($categoryId);
$allImages = $category->getAllImagesWithCategoryId($categoryId,false, $shuffle = false);

?>

<!-- Modal -->
<div class="modal fade" id="mashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content mash-bg">
            <div class="modal-header">
                <h5 class="modal-title blue-text modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mt-3 mb-3 d-flex justify-content-center align-content-center align-items-center">
                            <div class="card align-items-center cursor-pointer" onclick="selectUser('first')">
                                <input type="hidden" name="firstId">
                                <img src="" class="card-img-top imageFirst"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title usernameFirst"></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3 d-flex justify-content-center align-content-center align-items-center">
                            <div class="card align-items-center" onclick="selectUser('second')">
                                <input type="hidden" name="secondId">
                                <img src="" class="card-img-top imageSecond"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title usernameSecond"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End-->

<div class="container">
    <div class="row mt-3">
        <h1><?=$categorySumCount?></h1>

        <?=$renderedCategory?>
        <div class="container">
            <div class="row">
                <img src="/php/image.php?name=<?=$allImages[0]["image"];?>" alt="">
                <h1><?=$allImages[0]["count"];?></h1>

                <img src="/php/image.php?name=<?=$allImages[1]["image"];?>" alt="">
                <h1><?=$allImages[1]["count"];?></h1>

                <img src="/php/image.php?name=<?=$allImages[2]["image"];?>" alt="">
                <h1><?=$allImages[2]["count"];?></h1>
            </div>
        </div>
    </div>
</div>