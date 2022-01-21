function showHamburger()  {
    let nav = $("#navbar");
    let ham = $("#hamburger-menu");

    if (nav.is(":visible")) {
        nav.hide();
        
        ham.css("background-color", "#f5f5f5");
        ham.css("color", "#000000");
    } else {
        nav.show();
        
        ham.css("background-color", "#000000");
        ham.css("color", "#ffffff");
    }
}

function showNavbar() {
    let nav = $("#navbar");

    if (nav.not(":visible")) {
        nav.show();
    }
}

function displayMessage(text) {
    let msg = $("#info-message");

    msg.html(text);
    msg.css("display", "block");
}