<div class="fixed-bottom mb-3">
    <div class="container">

                <button type="button"
                        class="btn btn-outline-primary random-btn fw-bold d-flex justify-content-around align-items-center float-end"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" id="random-btn">
                    <i class="fas fa-dice" style="font-size: 24px;"></i>
                </button>

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
            <div class="modal-body d-md-flex justify-content-center align-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 d-flex justify-content-md-end justify-content-center align-content-md-end align-content-center align-items-md-end align-items-center">
                            <div class="card shadow align-items-center cursor-pointer" onclick="selectUser('first')">
                                <input type="hidden" name="firstId">
                                <img src="" class="card-img-top imageFirst"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title usernameFirst text-break text-center"></h5>
                                </div>
                                <div class="progress">
                                <span class="progress-bar d-flex" style="width: 25%">
                                    <strong class="text-white" id="progress-voted">25%</strong>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 mb-2 d-flex justify-content-center align-content-center align-items-center">
                            <span class="text-white">O R</span>
                        </div>
                        <div class="col-md-5 d-flex justify-content-md-start justify-content-center align-content-md-start align-content-center align-items-md-start align-items-center">
                            <div class="card shadow align-items-center" onclick="selectUser('second')">
                                <input type="hidden" name="secondId">
                                <img src="" class="card-img-top imageSecond"
                                     alt="">
                                <div class="card-body">
                                    <h5 class="card-title usernameSecond text-break text-center"></h5>
                                </div>
                                <div class="progress">
                                <span class="progress-bar progress-bar-not-selected d-flex" style="width: 75%">
                                    <strong class="text-white" id="progress-voted">75%</strong>
                                </span>
                                </div>
                            </div>
                        </div>
<!--                        <div class="row">-->
<!--                            <div class="col mt-3 d-flex justify-content-center">-->
<!--                                <div class="progress">-->
<!--                                <span class="progress-bar d-flex" style="width: 25%">-->
<!--                                    <strong class="text-white" id="progress-voted">25%</strong>-->
<!--                                </span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
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