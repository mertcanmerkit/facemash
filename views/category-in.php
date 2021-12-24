<?php
$categoryId = $explodedUrl[1];

$renderedCategory = $category->getRenderedCategory($categoryId);
$categorySumCount = $category->getCategorySumCount($categoryId);
$allImages = $category->getAllImagesWithCategoryId($categoryId, false, $shuffle = false);
array_splice($allImages, 5, count($allImages));

?>

<!-- Modal -->

<div class="modal fade" id="mashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content mash-bg">
            <div class="modal-header">
                <h5 class="modal-title blue-text modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-md-flex justify-content-center align-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 d-flex justify-content-md-end justify-content-center align-content-md-end align-content-center align-items-md-end align-items-center">
                            <div class="card firstCard shadow align-items-center cursor-pointer"
                                 onclick="selectUser('first')">
                                <input type="hidden" name="firstId">
                                <img src="" class="card-img-top imageFirst"
                                     alt="">
                                <div class="card-body" style="padding: 0;">
                                    <h5 class="card-title usernameFirst mt-3 text-break text-center"></h5>
                                </div>
                                <div class="progress" style="display: none;">
                                <span class="progress-bar d-flex firstProgress">
                                    <strong class="text-white firstProgressText" id="progress-voted"></strong>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 mb-2 d-flex justify-content-center align-content-center align-items-center">
                            <span class="text-white">O R</span>
                        </div>
                        <div class="col-md-5 d-flex justify-content-md-start justify-content-center align-content-md-start align-content-center align-items-md-start align-items-center">
                            <div class="card secondCard shadow align-items-center" onclick="selectUser('second')">
                                <input type="hidden" name="secondId">
                                <img src="" class="card-img-top imageSecond"
                                     alt="">
                                <div class="card-body" style="padding: 0;">
                                    <h5 class="card-title usernameSecond mt-3 text-break text-center"></h5>
                                </div>
                                <div class="progress" style="display: none;">
                                <span class="progress-bar progress-bar-not-selected d-flex secondProgress">
                                    <strong class="text-white secondProgressText" id="progress-voted"></strong>
                                </span>
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
        <?= $renderedCategory ?>
        <div class="col-lg-9 col-md-8 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-white img-cards">
                <h5 class="text-white text-break" style="padding: 1rem 1rem 0rem 1rem;">
                    Top Rated
                    <small id="copyAlert" class="float-end"></small>
                    <a id="share" onclick="copyToClipboard(url)">
                    <i class="fas fa-share-alt yellow-text float-end" style="font-size: 25px;"></i>
                    </a>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <ul class="statistics">
                            <?php
                            foreach ($allImages as $image) {
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="https://www.instagram.com/<?= $image["name"]; ?>" target="_blank">
                                        <img src="/php/image.php?name=<?= $image["image"]; ?>" class="list-avatar"
                                             alt="<?= $image["name"]; ?>">
                                    </a>
                                    <a href="https://www.instagram.com/<?= $image["name"]; ?>" target="_blank"
                                       class="me-auto"><?= "@" . $image["name"]; ?></a>
                                    <span class="voteCount float-end"><?= $image["count"]; ?> Votes</span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <p class="voteCount text-break" style="padding: 0rem 1rem 0rem 1rem;">The winners out of <?= $categorySumCount ?> votes.</p>
            </div>
        </div>
    </div>
</div>

<script>
    var url = window.location.href;
</script>




