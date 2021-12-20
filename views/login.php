<?php
if ($isLogged) {
    header("Location: /profile");
}
?>

<div class="container" style="color: #fff;">
    <div class="row">

        <h5 class="green-text text-break" id="myAlert" style="padding: 1rem 1rem 0rem 1rem;"></h5>
        <div class="col-12 col-md-6 mt-3 mb-3">
            <div id="guest-alert">

            </div>
            <div class="card card-shadow-green img-cards">
                <h5 class="green-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Sign In 🚀</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" id="inputEmailLogin" placeholder="email@example.com">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" id="inputPasswordLogin" placeholder="******">
                         <small id="passwordHelp" class="text-danger loginStatus d-flex">

                            </small>


                        </div>
                        <a href="password-reset" style="padding-top: 0">
                            <sub>Forgot your password?</sub>
                        </a>
                    </div>
                </div>

                <button type="button"
                        class="btn btn-outline-primary start-btn green-border green-text fw-bold" id="loginBtn" onclick="login()">
                    Login
                </button>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-3 mb-5">
            <div class="card card-shadow-pink img-cards">
                <h5 class="pink-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Don't have an account? 🚀
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" id="inputEmail" placeholder="email@example.com">
                            <small id="emailValidation" class="text-danger d-flex"></small>

                            <!-- <small id="passwordHelp" class="text-danger">
                                Please enter a valid email address.
                            </small> -->

                            <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "email") {
                                    echo '<small id="passwordHelp" class="text-danger">
                                The email already in use.
                            </small>';
                                }
                            }
                            ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input class="form-control" id="inputUsername" placeholder="@username">
                            <small id="usernameValidation" class="text-danger d-flex"></small>

                            <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "username") {
                                    echo '<small id="passwordHelp" class="text-danger d-flex">
                                The username already in use.
                            </small>';
                                }
                            }
                            ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" id="inputPassword" placeholder="******">
                            <small id="passValidation" class="text-danger d-flex"></small>

                            <!-- <small id="passwordHelp" class="text-danger">
                                Must be 8-20 characters long.
                            </small> -->
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary start-btn pink-border pink-text fw-bold" id="registerBtn"
                        onclick="register()">Sign
                    Up
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function query_string(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return (false);
    }

    let from = query_string("from")
    let id = query_string("id")

    const myAlert = document.getElementById("myAlert");
    const guestAlert = document.getElementById("guest-alert");

    switch (from) {
        case "add-photo":
            myAlert.innerText = "You must be logged in to add a photo!";
            break;
        case "add-category":
            myAlert.innerHTML = "You must be logged in to create a category!";
            break;
        case "mash":
            guestAlert.innerHTML = '<div class="alert alert-primary" role="alert">You can only vote by <a href="#" class="alert-link">registering as a guest</a>. You cannot add categories and photos.</div>';
            break;
        default:
    }
</script>
