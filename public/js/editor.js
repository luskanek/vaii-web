$(document).ready(function() {
    fetch('?c=home&a=getAllCategories')
        .then(response => response.json())
        .then(data => {
            for (let category of data) {
                let option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.name;

                document.getElementById("select-category").appendChild(option);
            }
        }
    );
    
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
})