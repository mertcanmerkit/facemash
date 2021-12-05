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
            //handle mert (response.reason)
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

            //handle mert (response.)
        }

    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}