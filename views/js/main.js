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

if (search_icon) {

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
}
const usernameInput = document.getElementById("inputUsername");
const usernameValidation = document.getElementById("usernameValidation");


function addSpinner(mClass) {
    $(mClass).append("  <span class=\"spinner-border spinner-border-sm mspinner_" + mClass.substring(1) + " \" role=\"status\" aria-hidden=\"true\"></span>\n")
}

function removeSpinner(mClass) {
    $(".mspinner_" + mClass.substring(1)).remove();
}

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
    addSpinner("#registerBtn");
    $.ajax(settings).done(function (response) {
        removeSpinner("#registerBtn");
        response = JSON.parse(response);
        if (response.error) {
            if (response.reason === 'email') {
                showSmall(emailValidation);
                setErrorFor(emailInput, "Email zaten bulunmakta!");

            } else if (response.reason === "username") {
                showSmall(usernameValidation);
                setErrorFor(usernameInput, "Username zaten bulunmakta!");

            }
        } else {
            setCookie("__token__", response.token, 10);
            let from = query_string("from")
            let id = query_string("id")

            switch (from) {
                case "add-photo":
                    location.href = from + "?id=" + id;
                    break;
                case "add-category":
                    location.href = from;
                    break;
                default:
                    location.href = "index";
            }
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
            let from = query_string("from")
            let id = query_string("id")

            switch (from) {
                case "add-photo":
                    location.href = from + "?id=" + id;
                    break;
                case "add-category":
                    location.href = from;
                    break;
                default:
                    location.href = "index";
            }

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

const firstUsernameInput = document.getElementById("firstUsername");
const firstUsernameValidation = document.getElementById("firstUsernameValidation");

if (firstUsernameInput != null) {
    firstUsernameInput.addEventListener("keyup", () => {
        firstUsernameInputValue = firstUsernameInput.value;

        if (firstUsernameInputValue.length < 0 || firstUsernameInputValue.length > 30) {
            showSmall(firstUsernameValidation);
            firstUsernameValidation.innerHTML = "0-30 olması lzm";
        } else if (firstUsernameInputValue.length == 0) {
            showSmall(firstUsernameValidation);
            firstUsernameValidation.innerHTML = "Boş olamaz";
        } else if (!firstUsernameInputValue.match(/^[a-zA-Z0-9._]+$/)) {
            showSmall(firstUsernameValidation);
            firstUsernameValidation.innerHTML = ">£#$½§ olmaz yawrum";
        } else {
            hideSmall(firstUsernameValidation);
        }
    })
}

const inputCategoryName = document.getElementById("inputCategoryName");
const categoryNameValidation = document.getElementById("categoryNameValidation");

if (inputCategoryName != null) {
    inputCategoryName.addEventListener("keyup", () => {
        inputCategoryNameValue = inputCategoryName.value;

        if (inputCategoryNameValue.length < 0 || inputCategoryNameValue.length > 30) {
            showSmall(categoryNameValidation);
            setErrorFor(inputCategoryName, "0-30 olması lzm");
        } else if (inputCategoryNameValue.length == 0) {
            showSmall(categoryNameValidation);
            setErrorFor(inputCategoryName, "Boş olamaz");
        } else {
            hideSmall(categoryNameValidation);
        }
    })
}

let emailInput = document.getElementById("inputEmail");
let emailValidation = document.getElementById("emailValidation");
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
        $(".reasons").html(response.reason);
        // *** **** handle mert please handle
        if (response.error) {

        } else {

        }

    });
}


function createSpinner(where) {
    if (where === "getCategories") {
        $(".categories-out").append('<div class="container"><div class="row justify-content-center align-content-center"><div class="d-flex spinner-border text-light getCategoriesSpinner" role="status">\n' +
            '  <span class="sr-only">Loading...</span>\n' +
            '</div></div></div>');
    } else if (where === "getUserCategories") {
        $(".user-categories").append('<div class="container"><div class="row justify-content-center align-content-center"><div class="d-flex spinner-border text-light getCategoriesSpinner" role="status">\n' +
            '  <span class="sr-only">ing...</span>\n' +
            '</div></div></div>');
    }
}

function deleteSpinner(where) {
    if (where === "getCategories") {
        $(".getCategoriesSpinner").remove();
    } else if (where === "getUserCategories") {
        $(".getCategoriesSpinner").remove();
    }
}

var inRequest = false;
var globalPage = 1;

function checkNeedNewCategory(where) {
    if (where == "getCategories") {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            getCategories(globalPage);
        }
        if ($(window).scrollTop() + $(window).height() < $(document).height() - 20) {
            getCategories(globalPage);
        }
    } else if (where === "getUserCategories") {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            getUserCategories(globalPage);
        }
        if ($(window).scrollTop() + $(window).height() < $(document).height() - 20) {
            getUserCategories(globalPage);
        }
    }

}

function getCategories(page) {
    if (inRequest)
        return;
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
    inRequest = true;
    createSpinner("getCategories");
    $.ajax(settings).done(function (response) {
        if (response === "") {
            deleteSpinner("getCategories");
            return

        }

        globalPage++;
        deleteSpinner("getCategories");
        inRequest = false;
        $(".categories-out").append(response);
        $('.carousel').carousel();
        checkNeedNewCategory("getCategories");
    });
}

function getUserCategories(page) {
    if (inRequest)
        return;
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
        "data": "page=" + page + "&operation=getUserAddedCategory"
    };
    inRequest = true;
    createSpinner("getUserCategories");
    $.ajax(settings).done(function (response) {
        if (response === "" || !response || response.length === 0) {
            if (globalPage === 1) {
                $(".category-empty").html("You have no categories. Why? You should add one. <br><a href='add-category' class='blue-text'>Click me to add category.</a>");
            }
            deleteSpinner("getUserCategories");
            return
        }
        globalPage++;
        deleteSpinner("getUserCategories");
        inRequest = false;
        $(".user-categories").append(response);
        $('.carousel').carousel();
        checkNeedNewCategory("getUserCategories");
    });
}

function addPhoto(id) {
    var name = $(".addPhoto").val();
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
        "data": "userName=" + name + "&categoryId=" + id + "&operation=addPhoto"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        console.log(response);
        if (response.error) {

        } else {

        }

    });
}

$(document).ready(function () {
    if ($(".categories-out")[0]) {
        getCategories(globalPage);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {

                getCategories(globalPage);
            }
        });
    } else if ($(".user-categories")[0]) {
        getUserCategories(globalPage);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {

                getUserCategories(globalPage);
            }
        });
    }
});

var mCategoryId = 0;

function startModalWithCategory(categoryId, show = true) {
    mCategoryId = categoryId;
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
        "data": "categoryId=" + categoryId + "&operation=getMash"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.error) {
            // *** **** handle mert please handle
            if (response.errorCode !== undefined && response.errorCode === 1) {
                window.location.href = '/category/' + mCategoryId;
            }
        } else {
            handleMashData(response.data, show)

        }
    });
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element).select();
    document.execCommand("copy");
    $temp.remove();
    $("#copyAlert").html("Copied");
    $("#share").hide();

    $("#copyAlert").fadeTo(1000, 500).slideUp(500, function () {
        $("#copyAlert").slideUp(500);
        $("#share").show();
    });


}


function createImageUrl(image) {
    return "/php/image.php?name=" + image;
}

function handleMashData(data, show) {
    if (data.length === 0 || data.length === 1) {
      //  location.href = "category/49";
        /** handle mert handle */
        return;
    }
    $(".modalTitle").html(data[0].categoryName);

    $(".usernameFirst").html("@" + data[0].name);
    $(".imageFirst").attr("src", createImageUrl(data[0].image));
    $("input[name=firstId]").val(data[0].categoryId);

    $(".imageSecond").attr("src", createImageUrl(data[1].image));
    $(".usernameSecond").html("@" + data[1].name);
    $("input[name=secondId]").val(data[1].categoryId);
    if (show)
        $("#mashModal").modal("show");
}

function selectUser(type) {
    var categoryDataId = $("input[name=" + type + "Id]").val();
    var firstId = $("input[name=firstId]").val();
    var secondId = $("input[name=secondId]").val();

    if (type === "first") {
        $(".firstCard").addClass("shadowC");
    } else {
        $(".secondCard").addClass("shadowC");
    }

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
        "data": "categoryDataId=" + categoryDataId + "&firstDataId=" + firstId + "&secondDataId=" + secondId + "&operation=selectUser"
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        if (response.error) {
            // *** **** handle mert please handle
        } else {
            $(".progress").show();

            $(".firstProgressText").html(response.firstScore + "%");
            $(".secondProgressText").html(response.secondScore + "%");

            $(".firstProgress").css("width", response.firstScore + "%");
            $(".secondProgress").css("width", response.secondScore + "%");
            const timeout = setTimeout(() => {
                console.log("timeOut");
                startModalWithCategory(mCategoryId, false);
                $(".progress").hide();
                $(".firstProgress").css("width", "0%");
                $(".secondProgress").css("width", "0%");
                $(".firstCard").removeClass("shadowC");
                $(".secondCard").removeClass("shadowC");

                clearTimeout(timeout)
            }, 2000);


        }
    });

}