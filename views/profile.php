<?php
if(!isset($_COOKIE[COOKIE_NAME])){
    header("Location: /login");
    die();
}
$user = new User($database->db);
$username = $user->getUser()["username"];
$id = $user->getUser()["id"];
$color = generateRandomColor();



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
    <div class="mt-3">
        <p><a href="logout" class="text-danger float-end ">Logout</a></p>
<!--        <a href=""><h5 class="--><?//=$color?><!---text"><i class="fas fa-user-cog float-end me-3" ></i></h5></a>-->
        <h5 class="<?=$color?>-text text-break d-inline"><?=$username?>'s</h5>
        <h5 class="<?=$color?>-text text-break d-inline">categories</h5>
    </div>

    <div class="row mt-3 user-categories">
        <p class="yellow-text category-empty text-center"></p>
    </div>

</div>