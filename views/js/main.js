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
