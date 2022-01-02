
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
                            <div class="card firstCard shadow align-items-center cursor-pointer" onclick="selectUser('first')">
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