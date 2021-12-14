<div class="container" style="color: #fff;">
    <div class="row">
        <div class="col-12 col-md-6 mt-3">
            <div class="card card-shadow-green img-cards">
                <h5 class="green-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Forgot Your Password?</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" id="inputEmailReset" placeholder="email@example.com">
                        </div>
                        <small id="passwordHelp" class="text-danger sendMailStatus d-flex">

                            </small>
                        <small>Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.</small>
                    </div>
                </div>

                <button type="button"
                        class="btn btn-outline-primary start-btn green-border green-text fw-bold" onclick="passwordReset()">
                    Send Reset E-Mail
                </button>
            </div>
        </div>
    </div>
</div>

