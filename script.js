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

window.onload = function() {
    var wrapper = document.getElementById("wrapper-images");
    var input = document.getElementById("input-new-images");

    input.addEventListener("change", function(e) {
        if (e.target.files.length > 12) {
            alert("Môžete nahrať maximálne 12 obrázkov!");
        }
        else {
        var images = wrapper.getElementsByTagName("img");

        while (images.length > 0) {
            wrapper.removeChild(images[0]);
        }
        
        var files = e.target.files;

        for (let i = 0; i < files.length; i++) {
            var file = files[i];

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
    }
    });
}