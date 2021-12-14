const body = document.body;
const hidden = "hidden";

const header = document.getElementById("header");
const scrollUp = "sticky-top";
const scrollDown = "scroll-down";
let lastScroll = 0;


window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= 0) {
        header.classList.remove(scrollUp);
        return;
    }

    if (currentScroll > lastScroll && !header.classList.contains(scrollDown)) {
        // down
        header.classList.remove(scrollUp);
        header.classList.add(scrollDown);
    } else if (
        currentScroll < lastScroll &&
        header.classList.contains(scrollDown)
    ) {
        // up
        header.classList.remove(scrollDown);
        header.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
});

const search_btn = document.getElementById("search-btn");
const search_icon = document.getElementById("search-icon");
const at_icon = document.getElementById("at-icon");
const search_input = document.getElementById("search-input");


search_icon.addEventListener("click", () => {
    search_input.placeholder = "username";
})
search_input.addEventListener("focus", () => {
    search_icon.classList.add(hidden);
    at_icon.classList.remove(hidden);
})
search_input.addEventListener("blur", () => {
    search_input.value = "";
    if (body.scrollWidth <= 768) {
        search_input.placeholder = "I'm going back!";
    }
    search_btn.classList.add(hidden);
    search_icon.classList.remove(hidden);
    at_icon.classList.add(hidden);
})
search_input.addEventListener("keydown", () => {
    search_btn.classList.remove(hidden);
    at_icon.classList.add(hidden);
})

const usernameInput = document.getElementById("inputUsername");
const usernameValidation = document.getElementById("usernameValidation");


function register() {
    var email = $("#inputEmail").val();
    var username = $("#inputUsername").val();
    var pass = $("#inputPassword").val();
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "email=" + email + "&username=" + username + "&pass=" + pass + "&operation=register"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.error) {
            if (response.reason === 'email') {
                console.log("email -> ", response)
                showSmall(emailValidation);
                setErrorFor(emailInput, "Email zaten bulunmakta!");

            } else if (response.reason === "username") {
                showSmall(usernameValidation);
                setErrorFor(usernameInput, "Username zaten bulunmakta!");

            }
        } else {
            setCookie("__token__", response.token, 10);
        }

    });
}

function login() {
    var email = $("#inputEmailLogin").val();
    var pass = $("#inputPasswordLogin").val();
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "email=" + email + "&pass=" + pass + "&operation=login"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.login) {
            setCookie("__token__", response.token, 10);
        } else {

            $(".loginStatus").text("Giriş yapılamadı.");
        }

    });
}

function passwordReset() {
    var email = $("#inputEmailReset").val();
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "email=" + email + "&operation=reset"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.reset) {
            // success
            $(".sendMailStatus").text("GÖNDERİLDİ");

        } else {

            $(".sendMailStatus").text("Sıfırlama Maili Gönderilemedi.");
        }

    });
}

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

function passwordChange() {
    secretKey = query_string('secretKey');
    var pass = $("#inputNewPassword").val();
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "pass=" + pass + "&secretKey=" + secretKey + "&operation=changePass"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);

        if (response.changePass) {
            // success
            $(".sendMailStatus").text("GÖNDERİLDİ");

        } else {

            $(".sendMailStatus").text("Sıfırlama Maili Gönderilemedi.");
        }

    });
}

if (usernameInput != null) {
    usernameInput.addEventListener("keyup", () => {
        usernameInputValue = usernameInput.value;

        if (usernameInputValue.length < 0 || usernameInputValue.length > 30) {
            showSmall(usernameValidation);
            setErrorFor(usernameInput, "0-30 olması lzm");
        } else if (usernameInputValue.length == 0) {
            showSmall(usernameValidation);
            setErrorFor(usernameInput, "Boş olamaz");
        } else if (!usernameInputValue.match(/^[a-zA-Z0-9._]+$/)) {
            showSmall(usernameValidation);
            setErrorFor(usernameInput, ">£#$½§ olmaz yawrum");
        } else {
            hideSmall(usernameValidation);
        }
    })
}


const emailInput = document.getElementById("inputEmail");
const emailValidation = document.getElementById("emailValidation");
if (emailInput != null && emailValidation != null) {

    emailInput.addEventListener("keyup", () => {
        emailInputValue = emailInput.value;

        if (!emailInputValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            showSmall(emailValidation);
            setErrorFor(emailInput, "No way! This e mail can't be real");
        } else {
            hideSmall(emailValidation);
        }
    })

}


const passInput = document.getElementById("inputPassword");
const passValidation = document.getElementById("passValidation");
if (passInput && passValidation) {

    passInput.addEventListener("keyup", () => {
        passInputValue = passInput.value;

        if (passInputValue.length < 5 || passInputValue.length > 31) {
            showSmall(passValidation);
            setErrorFor(passInput, "5-31 olcak");
        } else {
            hideSmall(passValidation);
        }
    })
}

function hideSmall(small) {
    small.classList.add("hidden");
    small.classList.remove("d-flex");
}

function showSmall(small) {
    small.classList.remove("hidden");
    small.classList.add("d-flex");
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText = message;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function addCategory() {
    var categoryName = $("#inputCategoryName").val();
    var firstUsername = $("#firstUsername").val();
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "firstUsername=" + firstUsername + "&categoryName=" + categoryName + "&operation=addCategory"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        console.log(response);

        // *** **** handle mert please handle
        if (response.error) {

        } else {

        }

    });
}


function getCategories(page) {
    var settings = {
        "url": "operations.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": "page=" + page + "&operation=getCategory"
    };

    $.ajax(settings).done(function (response) {
        $(".categories-out").append(response);
        $('.carousel').carousel();
    });


}

$(document).ready(function () {
    if ($(".categories-out")[0]) {
        getCategories(1);
    }
});