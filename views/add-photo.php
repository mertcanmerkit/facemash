<?php
if (!$isLogged) {
    header("Location: /login");
}
if (!isset($_GET["id"])) {
    header("HTTP/1.0 400 Bad Request");
    htmlDie("error");
}
$category = new Category($database->db);

$category = $category->getCategoryNameWithCategoryId($_GET["id"]);
if ($category == null && empty($category)) {
    header("HTTP/1.0 400 Bad Request");
    htmlDie("error");
    die();
}
?>

<div class="container" style="color: white;">
    <div class="row">
        <div class="mt-3">
            <div class="card card-shadow-blue img-cards">
                <h5 class="blue-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Add Photo to <?= $category ?>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">instagram.com/</span>
                            <input type="text" class="form-control addPhoto" id="basic-url"
                                   aria-describedby="basic-addon3"
                                   placeholder="username">
                        </div>

                        <small class="mb-3 text-break">The profile photo will be used for
                            voting.</small>
                        <!-- <small id="passwordHelp" class="text-danger">
                            You must add 2 photos to start a category.
                        </small> -->

                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn blue-border blue-text fw-bold"
                        onclick="addPhoto(<?= $_GET["id"] ?>);">Add
                </button>
            </div>
        </div>


    </div>


</div>
