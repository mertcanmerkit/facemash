<?php
if (!$isLogged) {
    header("Location: /login?from=add-photo&id=" . $_GET["id"] . "");
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
$reason = "";
if (isset($_GET["from"]) && $_GET["from"] == "index")
    $reason = "Please add second image";

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
                            <input type="text" class="form-control addPhoto" id="firstUsername"
                                   aria-describedby="basic-addon3"
                                   placeholder="username">
                        </div>
                        <small id="firstUsernameValidation" class="text-danger d-felx"><?= $reason ?></small>

                        <small class="mb-3 text-break">The profile photo will be used for
                            voting.</small>

                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn blue-border blue-text fw-bold"
                        id="addPhotoBtn"
                        onclick="addPhoto(<?= $_GET["id"] ?>);">Add
                </button>
            </div>
        </div>


    </div>


</div>
