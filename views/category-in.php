<?php
$categoryId = $explodedUrl[1];

$renderedCategory = $category->getRenderedCategory($categoryId);
$categorySumCount = $category->getCategorySumCount($categoryId);
$allImages = $category->getAllImagesWithCategoryId($categoryId, false, $shuffle = false,false);
array_splice($allImages, 5, count($allImages));

?>

<!-- Modal -->
<?php
include "modal.php";
?>

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
                                    <a href="profile/<?= $image["name"]; ?>">
                                        <img src="/php/image.php?name=<?= $image["image"]; ?>" class="list-avatar"
                                             alt="<?= $image["name"]; ?>">
                                    </a>
                                    <a href="profile/<?= $image["name"]; ?>"
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




