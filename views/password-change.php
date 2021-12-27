<div class="container" style="color: #fff;">
    <div class="row">
        <div class="col mt-3">
            <div class="card card-shadow-green img-cards">
                <h5 class="green-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Change Your Password</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Your new pass</label>
                            <input class="form-control" type="password" id="inputNewPassword" placeholder="******">
                        </div>
                        <small id="passwordHelp" class="text-danger newPassStatus d-flex"></small>
                    </div>
                </div>

                <button type="button"
                        class="btn btn-outline-primary start-btn green-border green-text fw-bold" id="passChangeBtn" onclick="passwordChange()">
                    Change
                </button>
            </div>
        </div>
    </div>
</div>

