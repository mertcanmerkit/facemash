<div class="fixed-bottom mb-3">
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <button type="button"
                        class="btn btn-outline-primary random-btn fw-bold d-flex justify-content-around align-items-center float-end"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" id="random-btn">
                    <i class="fas fa-dice" style="font-size: 24px;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

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
    <div class="row mt-3 categories-out">

    </div>

</div>