function showHamburger()  {
    var x = document.getElementById("navbar");
    var y = document.getElementById("hamburger-menu");

    if (x.style.display === "block") {
        x.style.display = "none";
        y.style.backgroundColor = "#ffffff";
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

function hideCategories() {
    var x = document.getElementById("categories");
    var y = document.getElementById("items");

    x.style.display = "none";
    y.style.display = "block";
}

function displayMessage(text) {
    var x = document.getElementById("info-message");

    x.innerHTML = text;
    x.style.display = "block";
}

window.onload = function() {
    var wrapper = document.getElementById("wrapper-images");
    var input = document.getElementById("input-new-images");
    var x = document.getElementById("info-message");
    var extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    input.addEventListener("change", function(e) {
        x.style.display = "none";
        var images = wrapper.getElementsByTagName("img");

        while (images.length > 0) {
            wrapper.removeChild(images[0]);
        }

        if (e.target.files.length > 10) {
            displayMessage("Môžete nahrať maximálne 10 obrázkov!");
            input.value = "";
        }
        else {
            var uploads = e.target.files;

            for (let i = 0; i < uploads.length; i++) {
                if (!extensions.exec(input.value)) {
                    displayMessage("Môžete nahrať len obrázky!");
                    input.value = "";
                    return false;
                }
                
                if ((input.files.item(i).size / 1024) > 8192) {
                    displayMessage("Môžete nahrať len obrázky s veľkosťou do 8MB!");
                    input.value = "";
                    return false;
                }
                
                var file = uploads[i];

                var Reader = new FileReader();
                Reader.addEventListener("load", function(e) {
                    var image = document.createElement("img");

                    image.src = e.target.result;
                    image.setAttribute("width", "100px");
                    image.setAttribute("height", "100px");

                    wrapper.appendChild(image);
                });

                Reader.readAsDataURL(file);
            }
            return true;
        }
    });
}