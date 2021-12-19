<?php

?>

<div class="container">
    <div class="row mt-3">
        <?php
        foreach ($category->getAllImagesWithCategoryId($explodedUrl[1], false) as $item) {
            ?>
            <div>
                <?= $item["name"] ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
