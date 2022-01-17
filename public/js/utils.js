function showHamburger()  {
    var x = document.getElementById("navbar");
    var y = document.getElementById("hamburger-menu");

    if (x.style.display === "block") {
        x.style.display = "none";
        y.style.backgroundColor = "#f5f5f5";
        y.style.color = "#000000";
    }
    else {
        x.style.display = "block";
        y.style.backgroundColor = "#000000";
        y.style.color = "#ffffff";
    }
}

function showNavbar() {
    var x = document.getElementById("navbar");

    if (x.style.display === "none") {
        x.style.display = "block";
    }
}

function displayMessage(text) {
    var x = document.getElementById("info-message");

    x.innerHTML = text;
    x.style.display = "block";
}