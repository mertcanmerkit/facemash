<?php
if (!$isLogged) {
    header("Location: /login?from=add-category");
}
?>
<div class="container" style="color: #fff;">
    <div class="row">
        <div class="mt-3">
            <div class="card card-shadow-blue img-cards">
                <h5 class="blue-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Create a New Category
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input class="form-control" id="inputCategoryName" placeholder="My College Boiys 🤙">
                            <small id="categoryNameValidation" class="text-danger d-felx"></small>
                        </div>

                        <label class="form-label">First Photo</label>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">instagram.com/</span>
                            <input type="text" class="form-control" id="firstUsername" aria-describedby="basic-addon3"
                                   placeholder="username">
                        </div>
                        <small id="firstUsernameValidation" class="text-danger d-felx"></small>


                        <small class="mb-3 text-break">Profile photos will be used for
                            voting.</small>
                        <!-- <small id="passwordHelp" class="text-danger">
                            You must add 2 photos to start a category.
                        </small> -->

                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn blue-border blue-text fw-bold" onclick="addCategory()">Create
                </button>
            </div>
        </div>


    </div>


</div>
